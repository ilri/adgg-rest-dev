<?php


namespace App\DataFixtures;


use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Nelmio\Alice\Loader\NativeLoader;

class AnimalFixtures extends Fixture implements FixtureGroupInterface
{
    private $baseDir;

    /**
     * AnimalFixtures constructor.
     */
    public function __construct()
    {
        $this->baseDir = dirname(__DIR__, 2);
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
        $loader = new NativeLoader();
        $objectSet = $loader->loadFile($this->baseDir . '/fixtures/animal.yaml')->getObjects();
        foreach ($objectSet as $object) {
            $manager->persist($object);
        }
        $manager->flush();
    }
}