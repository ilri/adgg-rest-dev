<?php

namespace App\EventListener;

use App\Entity\Animal;
use App\Entity\AnimalEvent;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Query\ResultSetMapping;

class AnimalEventListener
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof AnimalEvent) {
            // Check if animal_id is already provided
            if ($entity->getAnimal() !== null) {
                return; // Skip execution if animal_id is already provided
            }

            // Fetch the animal_id using the MySQL function
            $animalId = $this->fetchAnimalId($entity->getMobAnimalDataId());

            // If animal_id is still NULL, handle the error or provide a default value
            if ($animalId === null) {
                // If animal is not found, handle the error or provide a default value
                // In this example, an exception is thrown
                throw new \Exception('Animal not found for the provided mobAnimalDataId');
            }

            // Get the Animal entity by its ID
            $animalEntity = $this->entityManager->getRepository(Animal::class)->find($animalId);

            // Set the Animal entity on the Animal Event entity
            $entity->setAnimal($animalEntity);

            // Debugging: Output information for debugging
            error_log("Debugging - Animal ID set: " . $animalId);
        }
    }

    private function fetchAnimalId($mobAnimalDataId)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('animalId', 'animalId');

        $sql = 'SELECT setAnimalIdForAnimalEventProcedure(:mobAnimalDataId) as animalId';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter('mobAnimalDataId', $mobAnimalDataId);

        $result = $query->getSingleResult();

        return $result['animalId'];
    }
}