<?php

namespace PHPMaker2025\project1;

use PHPMaker2025\project1\Entity\Socio;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

class UserRepository extends EntityRepository implements UserLoaderInterface, PasswordUpgraderInterface
{
    /**
     * Used to upgrade (rehash) the user's password automatically over time
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Socio) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }
        $em = $this->getEntityManager();
        $user->upgradePassword($newHashedPassword);
        $em->persist($user);
        $em->flush();
    }

    /**
     * Loads the user for the given user identifier (e.g. username or email).
     *
     * This method must throw UserNotFoundException if the user is not found.
     *
     * @return UserInterface
     *
     * @throws UserNotFoundException
     */
    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = parent::findOneBy([
            "Cedula" => $identifier
        ]);
        if (null === $user) {
            $e = new UserNotFoundException(sprintf('User "%s" not found.', $identifier));
            $e->setUserIdentifier($identifier);
            throw $e;
        }
        return $user;
    }
}
