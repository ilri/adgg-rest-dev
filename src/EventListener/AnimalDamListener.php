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

            $mobDamId = $entity->getMobDamId();
            $registrationAnimalType = $entity->getAnimalType();

            // Check if animal type at registration allows it to be a dam
            $allowedDamTypes = [1, 2, 8, 9];
            if (!in_array($registrationAnimalType, $allowedDamTypes)) {
                throw new \Exception('This animal with mobDamDataId: ' . $mobDamId . ' is not a dam. It is a sire with AnimalType: ' . $registrationAnimalType);
            }else if ($mobDamId !== null){
                // Fetch the dam_id using the stored function
                $damId = (int) $this->fetchDamId($entity->getMobDamId());

                $entity->setDamId($damId);

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