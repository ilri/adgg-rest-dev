<?php

namespace App\DataFixtures;

use App\Entity\Herd;
use Doctrine\Bundle\FixturesBundle\{
    Fixture,
    FixtureGroupInterface,
};
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class HerdFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach (range(0, 10) as $value) {
            $herd = new Herd();
            $herd->setCountryId(rand(1, 3));
            $herd->setUuid(uniqid());
            $herd->setFarm($this->getReference('farm_%s', $value));
            $manager->persist($herd);
            $this->addReference(sprintf('herd_%s', $value), $herd);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            FarmFixtures::class,
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
