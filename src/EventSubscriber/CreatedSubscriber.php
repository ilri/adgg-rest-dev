<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;

final class CreatedSubscriber extends AuthCheckSubscriber
{
    public function setValue(ViewEvent $event): void
    {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($method !== Request::METHOD_POST) {
            return;
        }

        $trait = 'App\Entity\Traits\CreatedTrait';
        if (!$this->checkTrait($entity, $trait)) {
            return;
        }

        $user = $this->getUser();
        if ($user == null) {
            return;
        }

        $entity->setCreatedBy($user->getId());
    }
}