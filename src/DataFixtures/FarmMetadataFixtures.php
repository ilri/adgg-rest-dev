<?php

namespace App\DataFixtures;

use App\Entity\FarmMetadata;
use Doctrine\Bundle\FixturesBundle\{
    Fixture,
    FixtureGroupInterface,
};
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FarmMetadataFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach (range(1, 10) as $value) {
            $farmMetadata = new FarmMetadata();
            $farmMetadata->setType(rand(1, 22));
            $farmMetadata->setFarm($this->getReference(sprintf('farm_%s', $value)));
            $farmMetadata->setCountryId(rand(1, 3));
            $manager->persist($farmMetadata);
            $this->addReference(sprintf('farm_metadata_%s', $value), $farmMetadata);
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
