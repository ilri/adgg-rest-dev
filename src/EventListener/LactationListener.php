<?php

namespace App\EventListener;

use App\Entity\Animal;
use App\Entity\AnimalEvent;
use App\Entity\ParameterLimits;
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

        // Determine if an animal is a male animal
        $this->validateAnimalCanBeMilked($milkingEvent);

        $calving = $this->getLastCalvingEvent($animalEntity);

        if ($calving === null) {
            // Throw an exception if $calving is null
            throw new \RuntimeException('Calving is null for animal with ID: ' . $animalId);
        } else {
            try {
                // Pass the $calving argument to validateDIM
                $this->validateDIM($milkingEvent, $calving);
            } catch (\RuntimeException $e) {
                $validationErrors[] = $e->getMessage();
            }

            // Check if the total milk records meet the limits
            try {
                $this->validateTotalMilkRecords($milkingEvent);
            } catch (\RuntimeException $e) {
                $validationErrors[] = $e->getMessage();
            }

            try {
                $this->validateSomaticCellCount($milkingEvent);
            } catch (\RuntimeException $e) {
                $validationErrors[] = $e->getMessage();
            }

            try {
                $this->validateMilkLactose($milkingEvent);
            } catch (\RuntimeException $e) {
                $validationErrors[] = $e->getMessage();
            }

            try {
                $this->validateMilkProtein($milkingEvent);
            } catch (\RuntimeException $e) {
                $validationErrors[] = $e->getMessage();
            }

            try {
                $this->validateMilkFat($milkingEvent);
            } catch (\RuntimeException $e) {
                $validationErrors[] = $e->getMessage();
            }

            // Check for validation errors and throw a single exception if any
            if (!empty($validationErrors)) {
                throw new \RuntimeException(implode(" | ", $validationErrors));
            }

        }

        // Set the lactation ID of the new calving event
        $milkingEvent->setLactationId($calving->getId());
    }

    public function fetchAnimalId($mobAnimalDataId)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('animalId', 'animalId');

        $sql = 'SELECT fn_getAnimalId_mob(:mobAnimalDataId) as animalId';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter('mobAnimalDataId', $mobAnimalDataId);

        $result = $query->getSingleResult();

        return $result['animalId'];
    }

    private function fetchAnimalType($mobAnimalDataId)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('animalType', 'animalType');

        $sql = 'SELECT fn_getAnimalType_mob(:mobAnimalDataId) as animalType';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter('mobAnimalDataId', $mobAnimalDataId);

        $result = $query->getSingleResult();

        return $result['animalType'];
    }

    /**
     * Get the last calving event for an animal.
     *
     * @param Animal $animal
     * @return AnimalEvent|null
     */
    public function getLastCalvingEvent(Animal $animal): ?AnimalEvent
    {
        $events = $animal->getAnimalEvents()->filter(function (AnimalEvent $element) {
            return $element->getEventType() == AnimalEvent::EVENT_TYPE_CALVING;
        });

        return $events->first() ?: null;
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

    private function validateAnimalCanBeMilked(AnimalEvent $milkingEvent): void
    {
        $registrationAnimalType = (int)$this->fetchAnimalType($milkingEvent->getMobAnimalDataId());
        $maleAnimalTypes = [3, 5, 12, 10]; // Can be defined as a constant
        if (in_array($registrationAnimalType, $maleAnimalTypes)) {
            throw new \RuntimeException('A male animal cannot be milked: ' . $milkingEvent->getMobAnimalDataId());
        }
    }

    private function getTotalMilkRecord(AnimalEvent $milkingEvent): ?int
    {
        $additionalAttributes = $milkingEvent->getAdditionalAttributes();
        $morning = $additionalAttributes['59'] ?? 0;
        $evening = $additionalAttributes['61'] ?? 0;
        $midday = $additionalAttributes['68'] ?? 0;

        return $morning + $evening + $midday;
    }

    private  function  getSomaticCellRecord(AnimalEvent $milkingEvent): ?float
    {
        $additionalAttributes = $milkingEvent->getAdditionalAttributes();
        return $additionalAttributes['66'] ?? NULL;
    }

    private  function  getMilkLactoseRecord(AnimalEvent $milkingEvent): ?float
    {
        $additionalAttributes = $milkingEvent->getAdditionalAttributes();
        return $additionalAttributes['65'] ?? NULL;
    }

    private  function  getMilkProteinRecord(AnimalEvent $milkingEvent): ?float
    {
        $additionalAttributes = $milkingEvent->getAdditionalAttributes();
        return $additionalAttributes['64'] ?? NULL;
    }

    private  function  getMilkFatRecord(AnimalEvent $milkingEvent): ?float
    {
        $additionalAttributes = $milkingEvent->getAdditionalAttributes();
        return $additionalAttributes['63'] ?? NULL;
    }

    private function validateTotalMilkRecords(AnimalEvent $milkingEvent): float
    {
        $totalMilkRecord = $this->getTotalMilkRecord($milkingEvent);
        $milkAmountLimits = $this->getParameterListValues('milk_amount_limits');

        if (($totalMilkRecord < $milkAmountLimits['min_value'] || $totalMilkRecord >= $milkAmountLimits['max_value']) && $totalMilkRecord !== 0) {
            throw new \RuntimeException(sprintf(
                'Total Milk Records is not within the valid range (%f to %f) for animal: %s. You provided total milk: %f',
                $milkAmountLimits['min_value'],
                $milkAmountLimits['max_value'],
                $milkingEvent->getMobAnimalDataId(),
                $totalMilkRecord
            ));
        }

        return $totalMilkRecord;
    }

    private function validateSomaticCellCount(AnimalEvent $milkingEvent): ?float
    {
        $somaticCellCount = $this->getSomaticCellRecord($milkingEvent);
        $somaticCellCountLimits = $this->getParameterListValues('milk_somatic_cell_count_limits');

        if (($somaticCellCount < $somaticCellCountLimits['min_value'] || $somaticCellCount > $somaticCellCountLimits['max_value']) && $somaticCellCount !== NULL ) {
            throw new \RuntimeException(sprintf(
                'Somatic cell count is not within range (%f to %f) for animal: %s. You provided SCC of: %f',
                $somaticCellCountLimits['min_value'],
                $somaticCellCountLimits['max_value'],
                $milkingEvent->getMobAnimalDataId(),
                $somaticCellCount
            ));
        }

        return $somaticCellCount;
    }

    private function validateMilkProtein(AnimalEvent $milkingEvent): ?float
    {
        $milkProtein = $this->getMilkProteinRecord($milkingEvent);
        $milkProteinLimits = $this->getParameterListValues('milk_protein_limits');

        if (($milkProtein < $milkProteinLimits['min_value'] || $milkProtein > $milkProteinLimits['max_value']) && $milkProtein !== NULL) {
            throw new \RuntimeException(sprintf(
                'Milk Protein is not within the valid range (%f to %f) for animal: %s. You have provided: %f',
                $milkProteinLimits['min_value'],
                $milkProteinLimits['max_value'],
                $milkingEvent->getMobAnimalDataId(),
                $milkProtein
            ));
        }

        return $milkProtein;
    }

    private function validateMilkLactose(AnimalEvent $milkingEvent): ?float
    {
        $milkLactose = $this->getMilkLactoseRecord($milkingEvent);
        $milkLactoseLimits = $this->getParameterListValues('milk_lactose_limits');

        if(($milkLactose < $milkLactoseLimits['min_value'] || $milkLactose > $milkLactoseLimits['max_value'] ) & $milkLactose !== NULL){
            $validationErrors[] = sprintf(
                'Milk lactose  is not within range (%f to %f) for animal: %s. You have provided: %f',
                $milkLactoseLimits['min_value'],
                $milkLactoseLimits['max_value'],
                $milkingEvent->getMobAnimalDataId(),
                $milkLactose
            );
        }
        return $milkLactose;
    }

    private function  validateMilkFat(AnimalEvent $milkingEvent): ?float
    {
        $milkFat = $this->getMilkFatRecord($milkingEvent);
        $milkFatLimits = $this->getParameterListValues('milk_fat_limits');

        if(($milkFat < $milkFatLimits['min_value'] || $milkFat > $milkFatLimits['max_value'] ) & $milkFat !== NULL){
            $validationErrors[] = sprintf(
                'Milk Fat  is not within range (%f to %f) for animal: %s. You have provided: %f',
                $milkFatLimits['min_value'],
                $milkFatLimits['max_value'],
                $milkingEvent->getMobAnimalDataId(),
                $milkFat
            );
        }
        return $milkFat;
    }

    private function validateDIM(AnimalEvent $milkingEvent, AnimalEvent $calving): int
    {
        // Calculate the difference in days
        $daysInMilk = $calving->getEventDate()->diff($milkingEvent->getEventDate())->days;

        // Retrieve Days In Milk from parameterlist
        $daysInMilkLimits = $this->getParameterListValues('lactation_period');

        // Check if the difference is greater than or equal
        if (($daysInMilk < $daysInMilkLimits['min_value'] || $daysInMilk >= $daysInMilkLimits['max_value']) && $daysInMilk !== NULL) {
            throw new \RuntimeException(
                sprintf(
                    'Days In Milk is not within the valid range (%d to %d days) for animal: %s. You provided DIM of: %d',
                    $daysInMilkLimits['min_value'],
                    $daysInMilkLimits['max_value'],
                    $milkingEvent->getMobAnimalDataId(),
                    $daysInMilk
                )
            );
        }

        return $daysInMilk;
    }
}
