<?php


namespace App\DataFixtures;


use App\Entity\AuthUsers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    const PASSWORD = '$3CR3T';
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
    public static function getGroups(): array
    {
        return ['test'];
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $user = new AuthUsers();
        $user->setName('Test User');
        $user->setUsername('test');
        $user->setPasswordHash(
            $this->encoder->encodePassword($user, self::PASSWORD)
        );
        $user->setCreatedAt(new \DateTime());
        $user->setUuid('uuid');

        $manager->persist($user);
        $manager->flush();

        $this->addReference('test_user', $user);
    }
}