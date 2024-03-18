<?php

namespace App\EventListener;


use App\Entity\Animal;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\Event\LifecycleEventArgs;
class AnimalSireListener
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
            // Check if sire_id is provided in the post payload
            if ($entity->getSireId() !== null) {
                return; // Skip execution if herd_id is already provided
            }

            $mobSireId = $entity->getMobSireId();
            if($mobSireId === null){
                return;
            }
            $registrationAnimalType = (int) $this->fetchSireAnimalType($mobSireId);

            // Check if animal type at registration allows it to be a sire
            $allowedSireTypes = [3, 5, 10, 12];
            if (!in_array($registrationAnimalType, $allowedSireTypes)) {
                throw new \Exception('This animal with mobSireDataId: ' . $mobSireId . ' is not allowed as a sire. It is a Dam with Animal Type: ' . $registrationAnimalType);
            }else if ($mobSireId !== null) {
                // Fetch the dam_id using the stored function
                $sireId = (int) $this->fetchSireId($mobSireId);

                $entity->setSireId($sireId);

                // Flush the changes
                $this->entityManager->flush();
            }
        }
    }


    private function fetchSireId($mobSireDataId)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('sireId', 'sireId');

        $sql = 'SELECT fn_getSireID_mob(:mobSireDataId) as sireId';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter('mobSireDataId', $mobSireDataId);

        $result = $query->getSingleResult();

        return $result['sireId'];
    }

    private function fetchSireAnimalType($mobSireDataId)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('animalType', 'animalType');

        $sql = 'SELECT fn_getAnimalType_mob(:mobSireDataId) as animalType';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter('mobSireDataId', $mobSireDataId);

        $result = $query->getSingleResult();

        return $result['animalType'];
    }

}