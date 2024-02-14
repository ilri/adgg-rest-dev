<?php

namespace App\EventListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Entity\Animal;
use App\Entity\Farm;

class AnimalListener
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Animal) {
            // Check if farm_id is provided in the post payload
            if ($entity->getFarm() !== null) {
                return; // Skip execution if farm_id is already provided
            }

            $entityManager = $args->getObjectManager();

            // Fetch the Farm entity based on the provided mob_farm_id
//            $farm = $entityManager->getRepository(Farm::class)->findOneBy(['mob_data_id' => $entity->getMobFarmId()]);
            $farm = $entityManager->getRepository(Farm::class)->findOneBy(['mobDataId' => $entity->getMobFarmId()]);

            // If the farm doesn't exist, throw an exception
            if ($farm === null) {
                throw new \RuntimeException("An animal cannot be registered without a farm. Please register a farm first.");
            }

            // Set the farm_id on the Animal entity
            $entity->setFarmId($farm->getId());

            // Flush the changes
            $entityManager->flush();
        }
    }
}

