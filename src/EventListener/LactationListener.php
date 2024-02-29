<?php

namespace App\EventListener;

use App\Entity\Animal;
use App\Entity\AnimalEvent;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class LactationListener
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @ORM\PrePersist()
     *
     * @param AnimalEvent $milkingEvent
     * @param LifecycleEventArgs $event
     */
    public function prePersist(AnimalEvent $milkingEvent, LifecycleEventArgs $event): void
    {
        if ($milkingEvent->getEventType() !== AnimalEvent::EVENT_TYPE_MILKING) {
            return;
        }

        $animalId = $this->fetchAnimalId($milkingEvent->getMobAnimalDataId());

        if ($animalId === null) {
            throw new \RuntimeException('Animal is null in LactationListener for event with ID: ' . $milkingEvent->getId());
        }

        // Get the Animal entity by its ID
        $animalEntity = $this->entityManager->getRepository(Animal::class)->find($animalId);

        if ($animalEntity === null) {
            throw new \RuntimeException('Animal not found for ID: ' . $animalId);
        }

        $calving = $animalEntity->getLastCalving();

        if ($calving === null) {
            // Throw an exception if $calving is null
            throw new \RuntimeException('Calving is null for animal with ID: ' . $animalId);
        }

        $milkingEvent->setLactationId($calving->getId());
    }

    private function fetchAnimalId($mobAnimalDataId)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('animalId', 'animalId');

        $sql = 'SELECT fn_getAnimalId_mob(:mobAnimalDataId) as animalId';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter('mobAnimalDataId', $mobAnimalDataId);

        $result = $query->getSingleResult();

        return $result['animalId'];
    }
}
