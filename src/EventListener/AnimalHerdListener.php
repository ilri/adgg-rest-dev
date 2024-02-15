<?php

namespace App\EventListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Entity\Animal;
use App\Entity\Herd;

class AnimalHerdListener
{
        public function postPersist(LifecycleEventArgs $args)
        {
            $entity = $args->getObject();

            if ($entity instanceof Animal) {
                // Check if herd_id is provided in the post payload
                if ($entity->getHerdId() !== null) {
                    return; // Skip execution if herd_id is already provided
                }

                $entityManager = $args->getObjectManager();

                // Fetch the Herd entity based on the provided mob_herd_id
                $herd = $entityManager->getRepository(Herd::class)->findOneBy(['mobDataId' => $entity->getHerdId()]);

                // Set the farm_id on the Animal entity
                $entity->setHerdId($herd->getId());

                // Flush the changes
                $entityManager->flush();
            }
        }
}
