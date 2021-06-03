<?php

namespace App\DataFixtures;

use App\Entity\AnimalEvent;
use Doctrine\Bundle\FixturesBundle\{
    Fixture,
    FixtureGroupInterface,
};
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AnimalEventFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager): void
    {
        foreach (range(1, 10) as $value) {
            // create 10 calving events
            $calvingEvent = new AnimalEvent();
            $calvingEvent->setEventType(AnimalEvent::EVENT_TYPE_CALVING);
            $calvingEvent->setEventDate(new \DateTime());
            $calvingEvent->setCountryId(rand(1, 3));
            $calvingEvent->setUuid(uniqid());
            $calvingEvent->setAnimal($this->getReference(sprintf('animal_%s', $value)));
            $manager->persist($calvingEvent);
            $this->addReference(sprintf('calving_event_%s', $value), $calvingEvent);

            // create 10 milking events
            $milkingEvent = new AnimalEvent();
            $milkingEvent->setEventType(AnimalEvent::EVENT_TYPE_MILKING);
            $milkingEvent->setEventDate(new \DateTime());
            // the lactation id should be an id of a calving event
            // the calving event ids increment in step of 4: 1, 5, 9, ...
            $milkingEvent->setLactationId($value * 4 - 3);
            $milkingEvent->setCountryId(rand(1, 3));
            $milkingEvent->setUuid(uniqid());
            $milkingEvent->setAnimal($this->getReference(sprintf('animal_%s', $value)));
            $milkingEvent->setAdditionalAttributes([
                '59' => rand(3, 6),
                '61' => rand(3, 6),
                '68' => rand(2, 4),
            ]);
            $manager->persist($milkingEvent);
            $this->addReference(sprintf('milking_event_%s', $value), $milkingEvent);

            // create 10 exits events
            $exitsEvent = new AnimalEvent();
            $exitsEvent->setEventType(AnimalEvent::EVENT_TYPE_EXITS);
            $exitsEvent->setEventDate(new \DateTime());
            $exitsEvent->setCountryId(rand(1, 3));
            $exitsEvent->setUuid(uniqid());
            $exitsEvent->setAnimal($this->getReference(sprintf('animal_%s', $value)));
            $manager->persist($exitsEvent);
            $this->addReference(sprintf('exits_event_%s', $value), $exitsEvent);

            // create 10 other animal events
            $animalEvent = new AnimalEvent();
            $animalEvent->setEventType(rand(3, 16));
            $animalEvent->setEventDate(new \DateTime());
            $animalEvent->setCountryId(rand(1, 3));
            $animalEvent->setUuid(uniqid());
            $animalEvent->setAnimal($this->getReference(sprintf('animal_%s', $value)));
            $manager->persist($animalEvent);
            $this->addReference(sprintf('animal_event_%s', $value), $animalEvent);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            AnimalFixtures::class,
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
