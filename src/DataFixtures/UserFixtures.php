<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\{
    Fixture,
    FixtureGroupInterface,
};
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public const PASSWORD = '$3CR3T';
    private $encoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName('Test User');
        $user->setUsername('test');
        $user->setPasswordHash(
            $this->encoder->encodePassword($user, self::PASSWORD)
        );
        $user->setCreatedAt(new \DateTime());
        $user->setUuid('uuid');
        /** @noinspection PhpParamsInspection */
        $user->setRole($this->getReference('user_role_developer'));

        $manager->persist($user);
        $manager->flush();

        $this->addReference('test_user', $user);
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            UserRoleFixtures::class,
        ];
    }

    /**
     * @inheritDoc
     */
    public static function getGroups(): array
    {
        return ['test'];
    }
}