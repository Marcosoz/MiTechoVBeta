<?php

namespace PHPMaker2025\project1;

use Symfony\Component\Security\Core\User\InMemoryUser;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\ChainUserChecker;
use Symfony\Component\Cache\Adapter\NullAdapter;

/**
 * PHPMaker security configuration
 */
return [
    'SECURITY' => [
        'password_hashers' => [
            InMemoryUser::class => [ // Don't change!
                'algorithm' => 'bcrypt',
                'cost' => 15,
            ],

            // Legacy hasher
            'legacy' => [
                'id' => LegacyPasswordHasher::class
            ],
            PasswordAuthenticatedUserInterface::class => [
                'algorithm' => 'bcrypt',
                'cost' => 13, // Lowest possible value: 4
                'time_cost' => 4, // Lowest possible value: 3
                'memory_cost' => 64, // Lowest possible value: 10
                'migrate_from' => [
                    'legacy' // Uses the "legacy" hasher configured above
                ]
            ],
        ],
        'providers' => [
            'all_users' => [
                'chain' => [
                    'providers' => [
                    ],
                ],
            ],
        ],
        // See https://symfony.com/doc/current/security.html#a-authentication-firewalls
        'firewalls' => [
            'dev' => [
                'pattern' => '^/(_(profiler|wdt)|css|images|js)/',
                'security' => false,
            ],
            'main' => [
                'provider' => 'all_users',
                'user_checker' => 'security.user_checker.chain.main',
                'entry_point' => AuthenticationEntryPoint::class,
                'logout' => [
                    'path' => '/logout'
                ],
            ],
        ],
        // Easy way to control access for large sections of your site
        // Note: Only the *first* access control that matches will be used
        // Further access control to be done by permission middleware
        'access_control' => [
            [
                'path' => '^/login',
                'roles' => 'PUBLIC_ACCESS',
            ],
            [
                'path' => '^/register',
                'roles' => 'PUBLIC_ACCESS',
            ],
            [
                'path' => '^/resetpassword',
                'roles' => 'PUBLIC_ACCESS',
            ],
            [
                'path' => '^/index',
                'roles' => 'PUBLIC_ACCESS',
            ],
            [
                'path' => '^/$',
                'roles' => 'PUBLIC_ACCESS',
            ],
            [
                'request_matcher' => FirewallRequestMatcher::class,
            ],
        ],

        // The role_hierarchy values are static, they cannot be stored in a database.
        // See https://symfony.com/doc/current/security.html#hierarchical-roles
        'role_hierarchy' => [ // for static user levels only
            'ROLE_SUPER_ADMIN' => 'ROLE_ADMIN',
            'ROLE_ADMIN' => [
                'ROLE_USER',
                'ROLE_UNDEFINED'
            ],
            'ROLE_UNDEFINED' => [
                'ROLE_USER',
            ],
        ],
    ]
];
