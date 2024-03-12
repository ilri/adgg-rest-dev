<?php

namespace App\EventListener;

use App\Entity\Farm;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Entity\Animal;

class AnimalListener
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Animal) {
            // Check if farm_id is provided in the post payload
            if ($entity->getFarm() !== null) {
                return; // Skip execution if herd_id is already provided
            }

            // Fetch the farm_id using the stored function
            $farmId = $this->fetchFarmId($entity->getMobFarmId());

            $farm = $this->entityManager->getRepository(Farm::class)->find($farmId);

            // Set the farm_id on the Animal entity if it's not null
            if ($farm !== null) {
                $entity->setFarm($farm);

                // Flush the changes
                $this->entityManager->flush();
            }
        }
    }


    private function fetchFarmId($mobFarmDataId)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('farmId', 'farmId');

        $sql = 'SELECT fn_getFarmID_mob(:mobFarmDataId) as farmId';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter('mobFarmDataId', $mobFarmDataId);

        $result = $query->getSingleResult();

        return $result['farmId'];
    }
}
