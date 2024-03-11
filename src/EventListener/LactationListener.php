<?php

namespace App\EventListener;

use App\Entity\Animal;
use App\Entity\AnimalEvent;
use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class LactationListener
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @ORM\PrePersist()
     *
     * @param AnimalEvent $milkingEvent
     * @param LifecycleEventArgs $event
     */
    public function prePersist(AnimalEvent $milkingEvent, LifecycleEventArgs $event): void
    {
        if ($milkingEvent->getEventType() !== AnimalEvent::EVENT_TYPE_MILKING) {
            return;
        }

        $animalId = $this->fetchAnimalId($milkingEvent->getMobAnimalDataId());

        if ($animalId === null) {
            throw new \RuntimeException('Animal is null in LactationListener for event with ID: ' . $milkingEvent->getId());
        }

        // Get the Animal entity by its ID
        $animalEntity = $this->entityManager->getRepository(Animal::class)->find($animalId);

        if ($animalEntity === null) {
            throw new \RuntimeException('Animal not found for ID: ' . $animalId);
        }

        $calving = $this->getLastCalvingEvent($animalEntity);

        if ($calving === null) {
            // Throw an exception if $calving is null
            throw new \RuntimeException('Calving is null for animal with ID: ' . $animalId);
        } else {
            // Calculate the difference in days
            $daysinmilk = $calving->getEventDate()->diff($milkingEvent->getEventDate())->days;

            // Check if the difference is greater than or equal to 220 days
            if ($daysinmilk >= 1000) {
                throw new \RuntimeException('DIM(Days In Milk) is greater than or equal to 1000 days for animal with ID: ' . $animalId);
            }
            // Get the calving interval data
            $calvingIntervalResult = $this->getCalvingInterval($animalEntity);

            if ($calvingIntervalResult instanceof \RuntimeException) {
                // Handle the exception as needed
                throw $calvingIntervalResult;
            }
        }

        // Set the lactation ID of the new calving event
        $milkingEvent->setLactationId($calving->getId());


    }

    private function fetchAnimalId($mobAnimalDataId)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('animalId', 'animalId');

        $sql = 'SELECT fn_getAnimalId_mob(:mobAnimalDataId) as animalId';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter('mobAnimalDataId', $mobAnimalDataId);

        $result = $query->getSingleResult();

        return $result['animalId'];
    }

    /**
     * Get the last calving event for an animal.
     *
     * @param Animal $animal
     * @return AnimalEvent|null
     */
    private function getLastCalvingEvent(Animal $animal): ?AnimalEvent
    {
        $events = $animal->getAnimalEvents()->filter(function (AnimalEvent $element) {
            return $element->getEventType() == AnimalEvent::EVENT_TYPE_CALVING;
        });

        return $events->first() ?: null;
    }

    /**
     * Get the calving interval for an animal.
     *
     * @param Animal $animal
     * @return \RuntimeException|array
     */
    private function getCalvingInterval(Animal $animal)
    {
        $lastCalving = $this->getLastCalvingEvent($animal);
        $days = null;

        if ($lastCalving) {
            $days = Carbon::now()->diff($lastCalving->getEventDate())->days;
        }

        if ($days > 365) {
            // Return an exception if the calving interval exceeds 365 days
            return new \RuntimeException('Calving interval exceeds 365 days for animal with ID: ' . $animal->getId());
        }

        return [
            'days_since_last_calving' => $days,
        ];
    }

}
