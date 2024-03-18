<?php

namespace App\EventListener;

use App\Entity\Farm;
use App\Entity\Herd;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class AnimalCoreHerdListener
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Herd) {
            // Check if farm_id is provided in the post payload
            if ($entity->getFarm() !== null) {
                return; // Skip execution if herd_id is already provided
            }

            $mobFarm = $entity->getMobFarmId();

            if($mobFarm === null){
                return;
            }

            // Fetch the farm_id using the stored function
            $farmId = $this->fetchFarmForHerdId($mobFarm);

            $farm = $this->entityManager->getRepository(Farm::class)->find($farmId);

            // Set the farm_id on the Animal entity if it's not null
            if ($farm !== null) {
                $entity->setFarm($farm);

                // Flush the changes
                $this->entityManager->flush();
            }
        }
    }

    private function fetchFarmForHerdId($farmMobDataId)
    {
        if ($farmMobDataId === null) {
            // Handle null case appropriately
            throw new \InvalidArgumentException("Farm mob data  Id is null");
        }
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('farmId', 'farmId');

        $sql = 'SELECT fn_getFarmID_mob(:farmMobDataId) as farmId';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter('farmMobDataId', $farmMobDataId);

        $result = $query->getSingleResult();

        return $result['farmId'];
    }

}