<?php

namespace App\EventListener;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;
use App\Entity\ApiLogs;
use Doctrine\ORM\EntityManagerInterface;

class RequestResponseLogger
{
    private $requestStack;
    private $security;
    private $entityManager;

    public function __construct(RequestStack $requestStack, Security $security, EntityManagerInterface $entityManager)
    {
        $this->requestStack = $requestStack;
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        // Reopen the EntityManager if it's closed
        if (!$this->entityManager->isOpen()) {
            $connection = $this->entityManager->getConnection();
            $configuration = $this->entityManager->getConfiguration();
            $eventManager = $this->entityManager->getEventManager();

            $this->entityManager = new EntityManager($connection, $configuration, $eventManager);
        }

        $request = $this->requestStack->getCurrentRequest();
        $response = $event->getResponse();

        // Get request and response data
        $requestData = $request->getContent();
        $responseData = $response->getContent();

        // Create and persist a log entity
        $log = new ApiLogs();
        $log->setPayloadResponse(json_encode([
            'response' => $responseData,
        ]));
        $log->setPayloadRequest(json_encode([
            'request' => $requestData,
        ]));
        $log->setRequestUri($request->getRequestUri());

        // Set the authenticated user's ID if available
        if ($user = $this->security->getUser()) {
            $log->setUserId($user->getId());
        }

        // Set the request method (action) e.g., GET, POST, PUT, DELETE
        $log->setRequestMethod($request->getMethod());

        // Set the status code from the response
        $log->setStatusCode($response->getStatusCode());

        // Persist the log entity
        $this->entityManager->persist($log);
        $this->entityManager->flush();
    }
}
