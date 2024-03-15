<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use App\Entity\ApiLogs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class RequestResponseLogger
{
    private $entityManager;
    private $security;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        // Capture request data and store it in the log entity
        $request = $event->getRequest();
        $log = new ApiLogs();
        $log->setPayload($request->getContent());
        $log->setRequestUri($request->getUri());

        // Get the authenticated user's ID if available
        if ($user = $this->security->getUser()) {
            $log->setUserId($user->getId());
        }

        // Set the request method (action) e.g., GET, POST, PUT, DELETE
        $log->setRequestMethod($request->getMethod());

        // Persist the log entity
        $this->entityManager->persist($log);
        $this->entityManager->flush();
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        // Capture response data and update the corresponding log entity
        $response = $event->getResponse();
        $log = $this->entityManager->getRepository(ApiLogs::class)->findOneBy(['requestUri' => $event->getRequest()->getUri()]);
        if ($log instanceof ApiLogs) {
            $log->setStatusCode($response->getStatusCode());
            // Set other response data as needed

            $this->entityManager->flush();
        }
    }
}