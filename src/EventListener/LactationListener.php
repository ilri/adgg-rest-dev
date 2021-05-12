<?php

namespace App\EventListener;

use App\Entity\AnimalEvent;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class LactationListener
{
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

        $animal = $milkingEvent->getAnimal();
        $calving = $animal->getLastCalving();

        if (!$calving) {
            return;
        }

        $milkingEvent->setLactationId($calving->getId());
    }
}