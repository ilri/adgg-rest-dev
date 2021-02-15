<?php


namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Animal;
use App\Entity\AnimalEvent;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


final class AuthCheckSubscriber implements EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {

        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['getTokenUser', EventPriorities::PRE_WRITE],
        ];
    }

    public function getTokenUser(ViewEvent $event)
    {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        $entities = [Animal::class, AnimalEvent::class];
        $methods = [Request::METHOD_POST, Request::METHOD_PUT, Request::METHOD_PATCH];

        if (!in_array(get_class($entity), $entities) || !in_array($method, $methods)) {
            return;
        }

        $token = $this->tokenStorage->getToken();
        if (!$token) {
            return;
        }

        $user = $token->getUser();
        if (!$user instanceof User) {
            return;
        }

        $entity->setUuid(uniqid(sprintf('%s-', $user->getUsername())));

        if ($method == Request::METHOD_POST) {
            $entity->setCreatedBy($user->getId());
        } else {
            $entity->setUpdatedBy($user->getId());
            $entity->setUpdatedAt(new \DateTime());
        }
    }
}