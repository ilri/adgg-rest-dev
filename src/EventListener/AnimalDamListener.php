<?php

namespace App\EventListener;


use App\Entity\Animal;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\Event\LifecycleEventArgs;
class AnimalDamListener
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
            // Check if dam_id is provided in the post payload
            if ($entity->getDamId() !== null) {
                return; // Skip execution if herd_id is already provided
            }

            // Fetch the dam_id using the stored function
            $damId = $this->fetchDamId($entity->getMobDamId());

            $dam = $this->entityManager->getRepository(Animal::class)->find($damId);

            // Set the dam_id on the Animal entity if it's not null
            if ($dam !== null) {
                $entity->setDamId($dam);

                // Flush the changes
                $this->entityManager->flush();
            }
        }
    }


    private function fetchDamId($mobDamDataId)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('damId', 'damId');

        $sql = 'SELECT fn_getDamID_mob(:mobDamDataId) as damId';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter('mobDamDataId', $mobDamDataId);

        $result = $query->getSingleResult();

        return $result['damId'];
    }

}