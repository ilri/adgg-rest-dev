<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;

final class UpdatedSubscriber extends AuthCheckSubscriber
{
    public function setValue(ViewEvent $event): void
    {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($method !== Request::METHOD_PUT || $method !== Request::METHOD_PATCH) {
            return;
        }

        $trait = 'App\Entity\Traits\UpdatedTrait';
        if (!$this->checkTrait($entity, $trait)) {
            return;
        }

        $user = $this->getUser();
        if ($user == null) {
            return;
        }

        $entity->setUpdatedBy($user->getId());
    }
}
