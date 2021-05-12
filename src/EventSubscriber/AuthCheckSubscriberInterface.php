<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpKernel\Event\ViewEvent;

interface AuthCheckSubscriberInterface
{
    /**
     * @param ViewEvent $event
     */
    public function getTokenUser(ViewEvent $event): void;
}