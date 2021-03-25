<?php

namespace App\DataFixtures;

use App\Entity\Farm;
use Doctrine\Bundle\FixturesBundle\{
    Fixture,
    FixtureGroupInterface,
};
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FarmFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        foreach (range(1, 10) as $value) {
            $farm = new Farm();
            $farm->setName(sprintf('farm_%s', $value));
            $farm->setFarmerIsHhHead(true);
            $farm->setIsActive(true);
            $farm->setUuid(uniqid());
            $farm->setIsDeleted(false);
            $country = array_rand(CountryFixtures::COUNTRIES);
            $farm->setCountry($this->getReference(sprintf('country_%s', CountryFixtures::COUNTRIES[$country]['name'])));
            $manager->persist($farm);
            $this->addReference(sprintf('farm_%s', $value), $farm);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            CountryFixtures::class,
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
