<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\{
    Fixture,
    FixtureGroupInterface,
};
use Doctrine\Persistence\ObjectManager;

class AnimalFixtures extends Fixture implements FixtureGroupInterface
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        foreach (range(0, 10) as $value) {
            $animal = new Animal();
            $animal->setCountryId(rand(1, 3));
            $animal->setUuid(uniqid());
            $manager->persist($animal);
            $this->addReference(sprintf('animal_%s', $value), $animal);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public static function getGroups(): array
    {
        return ['test'];
    }
}
