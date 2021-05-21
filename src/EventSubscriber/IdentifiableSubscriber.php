<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;

final class IdentifiableSubscriber extends AuthCheckSubscriber implements EventSubscriberInterface
{
    public function setValue(ViewEvent $event): void
    {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($method !== Request::METHOD_POST) {
            return;
        }

        $trait = 'App\Entity\Traits\IdentifiableTrait';
        if (!$this->checkTrait($entity, $trait)) {
            return;
        }

        $user = $this->getUser();
        if ($user == null) {
            return;
        }

        $entity->setUuid(uniqid(sprintf('%s-', $user->getUsername())));
    }
}