<?php

namespace PHPMaker2025\project1;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\AuthenticationTokenCreatedEvent;
use Symfony\Component\Security\Http\Event\CheckPassportEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\Event\LoginFailureEvent;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;
use Symfony\Component\Security\Http\Event\LogoutEvent;
use Symfony\Component\Security\Http\Event\TokenDeauthenticatedEvent;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\PreAuthenticatedUserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CustomCredentials;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class AuthenticationEventSubscriber implements EventSubscriberInterface
{
    // Constructor
    public function __construct(
        protected UserProfile $profile,
        protected Language $language,
        protected AdvancedSecurity $security,
        protected Security $symfonySecurity,
        protected RequestStack $requestStack,
    ) {
    }

    /**
     * Priorities of listeners of CheckPassportEvent: (The higher the priority, the earlier a listener is executed.)
     * LoginThrottlingListener (2080)
     * security.listener.<firewall>.user_provider (2048)
     * UserProviderListener (1024)
     * CsrfProtectionListener (512)
     * UserCheckerListener (256) (CheckPassportEvent and AuthenticationSuccessEvent)
     * CheckLdapCredentialsListener (144)
     * CheckCredentialsListener (0)
     *
     * Priorities of listeners of KernelEvents::REQUEST:
     * DebugHandlersListener (2048)
     * ValidateRequestListener (256)
     * AbstractSessionListener (128)
     * AddRequestFormatsListener (100)
     * FragmentListener (48)
     * RouterListener (32)
     * LocaleListener (16)
     * LocaleAwareListener (15)
     * FirewallListener (8)
     * SwitchUserListener (0)
     * LogoutListener (-127)
     * AccessListener (-255)
     *
     * Priorities of listeners of KernelEvents::FINISH_REQUEST:
     * FirewallListener (0)
     * RouterListener (0)
     * LocaleListener (0)
     * LocaleAwareListener (-15)
     *
     * Priorities of listeners of LoginSuccessEvent:
     * SessionStrategyListener (0)
     * PasswordMigratingListener (0)
     * LoginThrottlingListener (0) - Enable RememberMeBadge
     * CheckRememberMeConditionsListener (-32) - Create cookie
     * RememberMeListener (-64)
     *
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            CheckPassportEvent::class => [
                ['onUserLogin', 164],
            ],
            AuthenticationTokenCreatedEvent::class => "onAuthenticationTokenCreated",
            AuthenticationEvents::AUTHENTICATION_SUCCESS => "onAuthenticationSuccess",
            LoginFailureEvent::class => "onLoginFailure",
            LoginSuccessEvent::class => "onLoginSuccess",
            LogoutEvent::class => "onLogout",
            KernelEvents::REQUEST => ['onKernelRequest', 1], // After FirewallListener (8)
            KernelEvents::FINISH_REQUEST => ["onFinishRequest", -1], // After FirewallListener (0)
        ];
    }

    public function onUserLogin(CheckPassportEvent $event): void
    {
    }

    public function onAuthenticationTokenCreated(AuthenticationTokenCreatedEvent $event): void
    {
        $token = $event->getAuthenticatedToken();
        $user = $token->getUser();
        $this->profile->setUser($user);
        $userName = $identifier = $user->getUserIdentifier();

        // Call User_CustomValidate event
        if ($this->security->userCustomValidate($userName) != false && $userName != $identifier) {
            $identifier = $userName;
        }

        // Try to find the entity user by identifier if authenticated by others, e.g. LDAP, HybridAuth, Windows, etc.
        if (
            !IsSysAdminUser($user) // Current user is not super admin
            && $identifier && ($entityUser = LoadUserByIdentifier($identifier)) // New entity user found
            && !$entityUser->isEqualTo($user) // New entity user != current user
        ) {
            $token = new UsernamePasswordToken($entityUser, "main", $entityUser->getRoles());
            $event->setAuthenticatedToken($token); // Change token
            $this->profile->setUser($entityUser); // Set current user
            if ($this->profile->get2FAEnabled() && !IsLoggedIn() && !IsLoggingIn() && !IsLoggingIn2FA()) {
                $this->profile->setUserName($identifier)->loadFromStorage();
                Session(SESSION_STATUS, "loggingin2fa");
                $token = new TwoFactorAuthenticatingToken($entityUser, "main", $entityUser->getRoles());
                $event->setAuthenticatedToken($token); // Change token
            }
        }
    }

    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event): void
    {
    }

    public function onLoginSuccess(LoginSuccessEvent $event): void
    {
        $user = $event->getUser();

        // $passport = $event->getPassport();
        // if (
        //     !$passport?->hasBadge(PasswordCredentials::class)
        //     && !$passport?->hasBadge(CustomCredentials::class)
        //     && !$passport?->hasBadge(PreAuthenticatedUserBadge::class)
        // ) {
        //     return; // Skip if no credentials
        // }
    }

    public function onLoginFailure(LoginFailureEvent $event): void
    {
        $passport = $event->getPassport();
        $userIdentifier = $passport?->getBadge(UserBadge::class)->getUserIdentifier();
    }

    public function onLogout(LogoutEvent $event): void
    {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $session = $event->getRequest()->getSession();
        $token = $this->symfonySecurity->getToken();
        $user = $token?->getUser();
    }

    public function onFinishRequest(FinishRequestEvent $event): void
    {
        if ($user = $this->symfonySecurity->getUser()) {
            $this->profile->setUser($user);
        }
    }

    // User Logged In event
    public function userLoggedIn(string $userName): void
    {
        //Log("User Logged In");
    }

    // User Login Error event
    public function userLoginError(string $userName, string $password): void
    {
        //Log("User Login Error");
    }

    // User Logging In event
    public function userLoggingIn(string $userName, string $password): bool
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }
}
