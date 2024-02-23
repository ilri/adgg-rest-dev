<?php

namespace App\EventListener;

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

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Animal) {
            // Check if farm_id is provided in the post payload
            if ($entity->getFarm() !== null) {
                return; // Skip execution if farm_id is already provided
            }

            // Fetch the farm_id using the stored function
            $farmId = $this->fetchFarmId($entity->getMobFarmId());

            // If the farm_id is not found, throw an exception
            if ($farmId === null) {
                throw new \RuntimeException("An animal cannot be registered without a farm. Please register a farm first.");
            }

            // Set the farm_id on the Animal entity
            $entity->setFarmId($farmId);

            // Flush the changes
            $this->entityManager->flush();
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
