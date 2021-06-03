<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\{
    Fixture,
    FixtureGroupInterface,
};
use Doctrine\Persistence\ObjectManager;

class CountryFixtures extends Fixture implements FixtureGroupInterface
{
    private const COUNTRIES = [
        [
            'name' => 'Tanzania',
            'code' => 'TZ',
        ],
        [
            'name' => 'Kenya',
            'code' => 'KE',
        ],
        [
            'name' => 'Ethiopia',
            'code' => 'ET',
        ],
    ];

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
        foreach (self::COUNTRIES as $value) {
            $country = new Country();
            $country->setCode(array_search($value, self::COUNTRIES) + 1);
            $country->setName($value['name']);
            $country->setCountry($value['code']);
            $country->setIsActive(true);
            $country->setUuid(uniqid());
            $country->setUnit1Name('Region');
            $country->setUnit2Name('District');
            $country->setUnit3Name('Ward');
            $country->setUnit4Name('Village');
            $country->setCreatedAt(new \DateTime());
            $manager->persist($country);
            $this->addReference(sprintf('country_%s', $value['name']), $country);
        }

        $manager->flush();
    }
}
