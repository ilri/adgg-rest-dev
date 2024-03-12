<?php

namespace App\EventListener;

use App\Entity\Animal;
use App\Entity\AnimalEvent;
use App\Entity\ParameterLimits;
use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use PhpParser\Node\Stmt\If_;

class CalvingIntervalListener
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @ORM\PrePersist()
     *
     * @param AnimalEvent $calvingEvent
     * @param LifecycleEventArgs $event
     */
    public function prePersist(AnimalEvent $calvingEvent, LifecycleEventArgs $event): void
    {
        if ($calvingEvent->getEventType() !== AnimalEvent::EVENT_TYPE_CALVING) {
            return;
        }

        // Call fetchAnimalId from LactationListener
        $animalId = $this->fetchAnimalId($calvingEvent->getMobAnimalDataId());

        if ($animalId === null) {
            throw new \RuntimeException('Animal is null in CalvingIntervalListener for event with ID: ' . $calvingEvent->getId());
        }

        // Get the Animal entity by its ID
        $animalEntity = $this->entityManager->getRepository(Animal::class)->find($animalId);

        if ($animalEntity === null) {
            throw new \RuntimeException('Animal not found for ID: ' . $animalId);
        }

        $calving = $this->getLastCalvingEvent($animalEntity);

        if ($calving === null) {
            throw new \RuntimeException('Calving event not found for animal with ID: ' . $animalId);
        } else {
            // Calculate the difference in days
            $calvingInterval = $calving->getEventDate()->diff($calvingEvent->getEventDate())->days;

            // Retrieve calving interval limits from parameterlist
            $calvingIntervalLimits = $this->getParameterListValues('calving_interval');
            $validationErrors = [];

            // Check if the difference is greater than or equal to 221 days
            if ($calvingInterval <= $calvingIntervalLimits['min_value'] || $calvingInterval >= $calvingIntervalLimits['max_value']) {
                $validationErrors[] = sprintf(
                    'Calving interval is not within the valid range (%d to %d days) for animal: %s',
                    $calvingIntervalLimits['min_value'],
                    $calvingIntervalLimits['max_value'],
                    $animalId
                );
            }

            // Calculate the age at first calving
            $ageAtFirstCalving = $animalEntity->getBirthdate()->diff($calvingEvent->getEventDate())->days;

            // Retrieve age at first calving limits from parameterlist
            $ageAtFirstCalvingLimits = $this->getParameterListValues('age_at_first_calving');

            // Convert age at first calving limits from months to days
            $ageAtFirstCalvingLimits = [
                'min_value' => $ageAtFirstCalvingLimits['min_value'] * 30, // assuming 30 days per month
                'max_value' => $ageAtFirstCalvingLimits['max_value'] * 30, // assuming 30 days per month
            ];

            // Check if age at first calving is less than 18 months (547 days)
            if ($ageAtFirstCalving < $ageAtFirstCalvingLimits['min_value'] || $ageAtFirstCalving >= $ageAtFirstCalvingLimits['max_value']) {
                $validationErrors[] = sprintf(
                    'Age at first calving is not within the valid range (%d to %d days) for animal: %s',
                    $ageAtFirstCalvingLimits['min_value'],
                    $ageAtFirstCalvingLimits['max_value'],
                    $animalId
                );
            }

            // Check for validation errors and throw a single exception if any
            if (!empty($validationErrors)) {
                throw new \RuntimeException(implode(" | ", $validationErrors));
            }
        }

    }

    private function fetchAnimalId($mobAnimalDataId)
    {
        // Call the method from LactationListener
        return (new LactationListener($this->entityManager))->fetchAnimalId($mobAnimalDataId);
    }

    /**
     * Get the last calving event for an animal.
     *
     * @param Animal $animal
     * @return AnimalEvent|null
     */
    private function getLastCalvingEvent(Animal $animal): ?AnimalEvent
    {
        // Call the method from LactationListener
        return (new LactationListener($this->entityManager))->getLastCalvingEvent($animal);
    }

    private function getParameterListValues($category)
    {
        $parameter = $this->entityManager
            ->getRepository(ParameterLimits::class)
            ->findOneBy(['category' => $category]);

        if ($parameter === null) {
            throw new \RuntimeException('Parameter not found for category: ' . $category);
        }

        return [
            'min_value' => $parameter->getMinValue(),
            'max_value' => $parameter->getMaxValue(),
        ];
    }

}