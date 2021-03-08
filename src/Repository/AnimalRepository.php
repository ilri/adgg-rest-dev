<?php

namespace App\Repository;

use App\Entity\Animal;
use App\Entity\AnimalEvent;
use Carbon\Carbon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

class AnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

    public function findAllMilkingEventsForAnimal(int $id): Collection
    {
        $animal = $this->findOneBy(['id' => $id]);

        $animalEvents = $animal->getAnimalEvents();

        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('eventType', AnimalEvent::EVENT_TYPE_MILKING));

        return $animalEvents->matching($criteria);
    }

    public function findAllCalvingEventsForAnimal(int $id): Collection
    {
        $animal = $this->findOneBy(['id' => $id]);

        $animalEvents = $animal->getAnimalEvents();

        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('eventType', AnimalEvent::EVENT_TYPE_CALVING));

        return $animalEvents->matching($criteria);
    }

    public function calculateAllDIMValuesForAnimal(int $id): array
    {
        $milkingEvents = $this->findAllMilkingEventsForAnimal($id);
        $calvingEvents = $this->findAllCalvingEventsForAnimal($id);

        $dimValues = [];

        foreach ($calvingEvents as $calvingEvent) {
            $matchingMilkingEvents = $milkingEvents->filter(function(AnimalEvent $milkingEvent) use ($calvingEvent) {
                return $milkingEvent->getLactationId() == $calvingEvent->getId();
            });
            foreach ($matchingMilkingEvents as $milkingEvent) {
                $milkingEventDate = Carbon::parse($milkingEvent->getEventDate()->format('Y-m-d'));
                $calvingEventDate = Carbon::parse($calvingEvent->getEventDate()->format('Y-m-d'));
                $dimValues[] = $milkingEventDate->diffInDays($calvingEventDate);
            }
        }

        return $dimValues;
    }

    public function calculateExpectedMilkYieldForAnimal(int $id): array
    {
        $dimValues = $this->calculateAllDIMValuesForAnimal($id);

        $emyValues = [];

        foreach ($dimValues as $dimValue) {
            $exponent = -0.0017 * $dimValue;
            $emy = 8.11 * pow($dimValue, 0.068) * exp($exponent);
            $emyValues[] = [
                'emy' => $emy,
                'TU' => $emy + 2.3,
                'TL' => $emy - 2.3
            ];
        }

        return $emyValues;
    }

    public function compareActualMilkRecordWithExpectedMilkYield($id)
    {
        $emy = $this->calculateExpectedMilkYieldForAnimal($id);
        $milkingEvents = $this->findAllMilkingEventsForAnimal($id);

        foreach ($milkingEvents as $milkingEvent) {
            $totalMilkRecord = $milkingEvent->calculateTotalMilkRecord();
            dump($totalMilkRecord);
        }
    }
}