<?php

namespace App\DataFixtures;

use App\Entity\TableAttribute;
use Doctrine\Bundle\FixturesBundle\{
    Fixture,
    FixtureGroupInterface,
};
use Doctrine\Persistence\ObjectManager;

class TableAttributeFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $testAttr = new TableAttribute();
        $testAttr->setAttributeKey('test');
        $testAttr->setAttributeLabel('Test');
        $testAttr->setTableId(1);
        $testAttr->setInputType(1);
        $testAttr->setCreatedAt(new \DateTime());
        $manager->persist($testAttr);
        $this->addReference('testAttr', $testAttr);

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
