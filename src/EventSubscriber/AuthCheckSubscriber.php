<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class AuthCheckSubscriber implements EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

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
            KernelEvents::VIEW => ['getTokenUser', EventPriorities::PRE_WRITE],
        ];
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