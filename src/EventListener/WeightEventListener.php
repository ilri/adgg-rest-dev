<?php

namespace App\EventListener;

use App\Entity\Animal;
use App\Entity\AnimalEvent;
use App\Entity\ParameterLimits;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class WeightEventListener
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @ORM\PrePersist()
     *
     * @param AnimalEvent $weightEvent
     * @param LifecycleEventArgs $event
     */
    public function prePersist(AnimalEvent $weightEvent, LifecycleEventArgs $args): void
    {
        if ($weightEvent->getEventType() !== AnimalEvent::EVENT_TYPE_WEIGHTS) {
            return;
        }

        $animalId = $this->fetchWeightAnimalId($weightEvent->getMobAnimalDataId());

        if ($animalId === null) {
            throw new \RuntimeException('Animal is null for weight event with ModDataID: ' . $weightEvent->getMobAnimalDataId());
        }


        $validationErrors = [];

        // Validate Mature Heart Girth if the attribute exists
        if (isset($additionalAttributes['137'])) {
            try {
                $this->validateMatureHeartGirth($weightEvent);
            } catch (\RuntimeException $e) {
                $validationErrors[] = $e->getMessage();
            }
        }

        // Validate Mature Weight Limits if the attribute exists
        if (isset($additionalAttributes['136'])) {
            try {
                $this->validateMatureWeightLimits($weightEvent);
            } catch (\RuntimeException $e) {
                $validationErrors[] = $e->getMessage();
            }
        }

        // Validate Mature Body Condition Score if the attribute exists
        if (isset($additionalAttributes['139'])) {
            try {
                $this->validateMatureAnimalBodyConditionScore($weightEvent);
            } catch (\RuntimeException $e) {
                $validationErrors[] = $e->getMessage();
            }
        }

        // Validate Mature Body Length if the attribute exists
        if (isset($additionalAttributes['138'])) {
            try {
                $this->validateMatureAnimalBodyLength($weightEvent);
            } catch (\RuntimeException $e) {
                $validationErrors[] = $e->getMessage();
            }
        }

        // Validate Calf Body Condition Score if the attribute exists
        if (isset($additionalAttributes['139'])) {
            try {
                $this->validateCalfBodyConditionScore($weightEvent);
            } catch (\RuntimeException $e) {
                $validationErrors[] = $e->getMessage();
            }
        }

        // Validate Calf Weight Limits if the attribute exists
        if (isset($additionalAttributes['136'])) {
            try {
                $this->validateCalfWeightLimits($weightEvent);
            } catch (\RuntimeException $e) {
                $validationErrors[] = $e->getMessage();
            }
        }

        // Validate Calf Heart Girth if the attribute exists
        if (isset($additionalAttributes['137'])) {
            try {
                $this->validateCalfHeartGirth($weightEvent);
            } catch (\RuntimeException $e) {
                $validationErrors[] = $e->getMessage();
            }
        }

        // Validate Calf Body Length if the attribute exists
        if (isset($additionalAttributes['138'])) {
            try {
                $this->validateCalfBodyLength($weightEvent);
            } catch (\RuntimeException $e) {
                $validationErrors[] = $e->getMessage();
            }
        }

        // Check for validation errors and throw a single exception if any
        if (!empty($validationErrors)) {
            throw new \RuntimeException(implode(" | ", $validationErrors));
        }

    }

    private function fetchWeightAnimalId($mobAnimalDataId)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('animalId', 'animalId');

        $sql = 'SELECT fn_getAnimalID_mob(:mobAnimalDataId) as animalId';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter('mobAnimalDataId', $mobAnimalDataId);

        $result = $query->getSingleResult();

        return $result['animalId'];
    }

    private function validateMatureHeartGirth(AnimalEvent $weightEvent): float
    {
        // Call the new getMatureHeartGirthLimitsRecord method
        $heartGirth = $this->getMatureHeartGirthLimitsRecord($weightEvent);

        // Retrieve Mature Heart Girth limits from parameter list
        $heartGirthLimits = $this->getParameterListValues('mature_heart_girth_limits');

        // Check if the Heart Girth records meet the limits
        if (($heartGirth < $heartGirthLimits['min_value'] || $heartGirth >= $heartGirthLimits['max_value']) & $heartGirth !== NULL) {
            throw new \RuntimeException(sprintf(
                'Mature animal Heart Girth should be in the range (%f to %f) for animal: %s',
                $heartGirthLimits['min_value'],
                $heartGirthLimits['max_value'],
                $weightEvent->getMobAnimalDataId()
            ));
        }
        return $heartGirth;
    }

    private function getMatureHeartGirthLimitsRecord(AnimalEvent $weightEvent): ?float
    {
        $additionalAttributes = $weightEvent->getAdditionalAttributes();
        return $additionalAttributes['137'] ?? NULL;
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

    private function validateMatureWeightLimits(AnimalEvent $weightEvent): float
    {

        // Call the new getMatureWeightLimitsRecord method
        $weight = $this->getMatureWeightLimitsRecord($weightEvent);

        // Retrieve Mature Animal weight limits from parameter list
        $weightLimits = $this->getParameterListValues('mature_weight_limits');

        // Check if the Heart Girth records meet the limits
        if (($weight < $weightLimits['min_value'] || $weight >= $weightLimits['max_value']) & $weight !== NULL) {
            throw new \RuntimeException(sprintf(
                'Mature animal Weight should be in the range (%f to %f) for animal: %s',
                $weightLimits['min_value'],
                $weightLimits['max_value'],
                $weightEvent->getMobAnimalDataId()
            ));
        }
        return $weight;

    }

    private function getMatureWeightLimitsRecord(AnimalEvent $weightEvent): ?float
    {
        $additionalAttributes = $weightEvent->getAdditionalAttributes();
        return $additionalAttributes['136'] ?? NULL;
    }

    private function validateMatureAnimalBodyConditionScore(AnimalEvent $weightEvent): float
    {
        $bodyConditionScore = $this->getMatureBodyCondScoreRecord($weightEvent);

        // Retrieve Mature Heart Girth limits from parameter list
        $bodyConditionScoreLimits = $this->getParameterListValues('mature_body_cond_score');

        // Check if the Heart Girth records meet the limits
        if (($bodyConditionScore < $bodyConditionScoreLimits['min_value'] || $bodyConditionScore >= $bodyConditionScoreLimits['max_value']) & $bodyConditionScore !== NULL) {
            throw new \RuntimeException(sprintf(
                'Mature animal body condition score should be in the range (%f to %f) for animal: %s',
                $bodyConditionScoreLimits['min_value'],
                $bodyConditionScoreLimits['max_value'],
                $weightEvent->getMobAnimalDataId()
            ));
        }
        return $bodyConditionScore;

    }

    private function getMatureBodyCondScoreRecord(AnimalEvent $weightEvent): ?float
    {
        $additionalAttributes = $weightEvent->getAdditionalAttributes();
        return $additionalAttributes['139'] ?? NULL;
    }

    private function validateMatureAnimalBodyLength(AnimalEvent $weightEvent): float
    {
        $bodyLength = $this->getMatureBodyLengthRecord($weightEvent);

        // Retrieve Mature body length limits from parameter list
        $bodyLengthLimits = $this->getParameterListValues('mature_body_length');

        // Check if the Heart Girth records meet the limits
        if (($bodyLength < $bodyLengthLimits['min_value'] || $bodyLength >= $bodyLengthLimits['max_value']) & $bodyLength !== NULL) {
            throw new \RuntimeException(sprintf(
                'Mature animal body length should be in the range (%f to %f) for animal: %s',
                $bodyLengthLimits['min_value'],
                $bodyLengthLimits['max_value'],
                $weightEvent->getMobAnimalDataId()
            ));
        }
        return $bodyLength;
    }

    private function getMatureBodyLengthRecord(AnimalEvent $weightEvent): ?float
    {
        $additionalAttributes = $weightEvent->getAdditionalAttributes();
        return $additionalAttributes['138'] ?? NULL;
    }

    private function validateCalfBodyConditionScore(AnimalEvent $weightEvent): float
    {
        $registrationAnimalType = (int)$this->fetchAnimalType($weightEvent->getMobAnimalDataId());

        $calfBodyLength = $this->getMatureBodyLengthRecord($weightEvent);

        // Retrieve Body Length limits from parameter list
        $calfBodyLengthLimits = $this->getParameterListValues('calf_body_cond_score');

        if (($calfBodyLength < $calfBodyLengthLimits['min_value'] ||
                $calfBodyLength >= $calfBodyLengthLimits['max_value']) &&
            $calfBodyLength !== NULL &&
            in_array($registrationAnimalType, [3, 4, 9, 10])
        ) {
            throw new \RuntimeException(sprintf(
                'Calf body length should be in the range (%f to %f) for animal: %s',
                $calfBodyLengthLimits['min_value'],
                $calfBodyLengthLimits['max_value'],
                $weightEvent->getMobAnimalDataId()
            ));
        }
        return $calfBodyLength;
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

    private function validateCalfWeightLimits(AnimalEvent $weightEvent): float
    {
        $registrationAnimalType = (int)$this->fetchAnimalType($weightEvent->getMobAnimalDataId());

        $calfWeight = $this->getMatureWeightLimitsRecord($weightEvent);

        // Retrieve Calf weight limits from parameter list
        $calfWeightLimits = $this->getParameterListValues('calf_weight_limits');

        if (($calfWeight < $calfWeightLimits['min_value'] ||
                $calfWeight >= $calfWeightLimits['max_value']) &&
            $calfWeight !== NULL &&
            in_array($registrationAnimalType, [3, 4, 9, 10])
        ) {
            throw new \RuntimeException(sprintf(
                'Calf weight should be in the range (%f to %f) for animal: %s',
                $calfWeightLimits['min_value'],
                $calfWeightLimits['max_value'],
                $weightEvent->getMobAnimalDataId()
            ));
        }
        return $calfWeight;
    }

    private function validateCalfHeartGirth(AnimalEvent $weightEvent): float
    {
        $registrationAnimalType = (int)$this->fetchAnimalType($weightEvent->getMobAnimalDataId());

        $calfHeartGirth = $this->getMatureHeartGirthLimitsRecord($weightEvent);

        // Retrieve Calf Heart Girth limits from parameter list
        $calfHeartGirthLimits = $this->getParameterListValues('calf_heart_girth_limits');

        if (($calfHeartGirth < $calfHeartGirthLimits['min_value'] ||
                $calfHeartGirth >= $calfHeartGirthLimits['max_value']) &&
            $calfHeartGirth !== NULL &&
            in_array($registrationAnimalType, [3, 4, 9, 10])
        ) {
            throw new \RuntimeException(sprintf(
                'Calf Heart Girth should be in the range (%f to %f) for animal: %s',
                $calfHeartGirthLimits['min_value'],
                $calfHeartGirthLimits['max_value'],
                $weightEvent->getMobAnimalDataId()
            ));
        }
        return $calfHeartGirth;
    }

    private function validateCalfBodyLength(AnimalEvent $weightEvent): float
    {
        $registrationAnimalType = (int)$this->fetchAnimalType($weightEvent->getMobAnimalDataId());
        $calfBodyLength = $this->getMatureBodyLengthRecord($weightEvent);

        // Retrieve Calf Heart Girth limits from parameter list
        $calfBodyLengthLimits = $this->getParameterListValues('calf_body_length');

        if (($calfBodyLength < $calfBodyLengthLimits['min_value'] ||
                $calfBodyLength >= $calfBodyLengthLimits['max_value']) &&
            $calfBodyLength !== NULL &&
            in_array($registrationAnimalType, [3, 4, 9, 10])
        ) {
            throw new \RuntimeException(sprintf(
                'Calf Body Length should be in the range (%f to %f) for animal: %s',
                $calfBodyLengthLimits['min_value'],
                $calfBodyLengthLimits['max_value'],
                $weightEvent->getMobAnimalDataId()
            ));
        }
        return $calfBodyLength;
    }

}