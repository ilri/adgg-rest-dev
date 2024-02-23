<?php

namespace App\EventListener;

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

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Animal) {
            // Check if herd_id is provided in the post payload
            if ($entity->getHerdId() !== null) {
                return; // Skip execution if herd_id is already provided
            }

            // Fetch the herd_id using the stored function
            $herdId = $this->fetchHerdId($entity->getHerdId());

            // Set the herd_id on the Animal entity if it's not null
            if ($herdId !== null) {
                $entity->setHerdId($herdId);

                // Flush the changes
                $this->entityManager->flush();
            }
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
