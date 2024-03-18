<?php

namespace App\EventListener;

use App\Entity\Herd;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Entity\Animal;

class AnimalHerdListener
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
            if ($entity->getHerdId() !== null) {
                return; // Skip execution if herd_id is already provided
            }

            $mobHerdId = $entity->getMobHerdId();

            if($mobHerdId === null){
                return;
            }

            // Fetch the farm_id using the stored function
            $herdId = $this->fetchHerdId($entity->getMobHerdId());

            $entity->setHerdId($herdId);

            $this->entityManager->flush();
        }
    }

    private function fetchHerdId($mobFarmDataId)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('herdId', 'herdId');

        $sql = 'SELECT fn_getHerdID_mob(:mobHerdDataId) as herdId';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter('mobHerdDataId', $mobFarmDataId);

        $result = $query->getSingleResult();

        return $result['herdId'];
    }

}
