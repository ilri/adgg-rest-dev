<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


abstract class AuthCheckSubscriber implements EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * AuthCheckSubscriber constructor.
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['setValue', EventPriorities::PRE_WRITE],
        ];
    }

    /**
     * @param ViewEvent $event
     */
    public function setValue(ViewEvent $event)
    {
        throw new \LogicException(sprintf('Child class must implement method %s.', __FUNCTION__));
    }

    /**
     * @param $entity
     * @param string $trait
     * @return bool
     */
    protected function checkTrait($entity, string $trait): bool
    {
        $usedTraits = class_uses($entity);
        return in_array($trait, $usedTraits);
    }

    /**
     * @return User|null
     */
    protected function getUser(): ?User
    {
        $token = $this->tokenStorage->getToken();
        if (!$token) {
            return null;
        }

        $user = $token->getUser();

        return $user instanceof User ? $user : null;
    }
}
