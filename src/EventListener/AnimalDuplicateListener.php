<?php

namespace App\EventListener;

use App\Entity\Animal;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class AnimalDuplicateListener
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // Check if the entity is an instance of Animal
        if (!$entity instanceof Animal) {
            return;
        }

        $villageId = $entity->getVillageId();
        $farmId = $entity->getFarmId();
        $tagId = $entity->getTagId();

        // Query to check for duplicate records
        $existingAnimal = $this->entityManager
            ->getRepository(Animal::class)
            ->findOneBy([
                'villageId' => $villageId,
                'farmId' => $farmId,
                'tagId' => $tagId
            ]);

        if ($existingAnimal !== null) {
            throw new \Exception('Duplicate record found.');
        }
    }
}