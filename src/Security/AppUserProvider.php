<?php

// src/Security/AppUserProvider.php

namespace App\Security;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class AppUserProvider implements UserProviderInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function loadUserByUsername($username)
    {
        // Look for the user based on either the username or email
        $user = $this->em->getRepository(User::class)->findOneBy(['username' => $username]);

        if (!$user) {
            // If the user is not found by username, try fetching by email
            $user = $this->em->getRepository(User::class)->findOneBy(['email' => $username]);
        }

        if (!$user) {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        // This method is used when you have a user object and want to fetch a fresh user
        // For simplicity, we don't implement it here
        throw new UnsupportedUserException('Refreshing user is not supported.');
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}
