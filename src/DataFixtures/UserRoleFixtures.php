<?php

namespace App\DataFixtures;

use App\Entity\UserRole;
use Doctrine\Bundle\FixturesBundle\{
    Fixture,
    FixtureGroupInterface,
};
use Doctrine\Persistence\ObjectManager;

class UserRoleFixtures extends Fixture implements FixtureGroupInterface
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $userRole = new UserRole();
        $userRole->setName('DEVELOPER');

        $manager->persist($userRole);
        $manager->flush();

        $this->addReference('user_role_developer', $userRole);
    }

    /**
     * @inheritDoc
     */
    public static function getGroups(): array
    {
        return ['test'];
    }
}
