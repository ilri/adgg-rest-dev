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

            // Check if animal type is 1, 2, 8, 9
            $allowedAnimalTypes = [1, 2, 8, 9];
            // Set the sire_id on the Animal entity if it's not null, also confirm that it is not an AI straw
            if (!in_array($entity->getAnimalType(), $allowedAnimalTypes)) {
                throw new \Exception('This animal with mobSireDataId: ' .$mobSireId  ." is a bisexual");
            }else{
                // Fetch the dam_id using the stored function
                $sireId = (int) $this->fetchSireId($entity->getSireId());

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

}