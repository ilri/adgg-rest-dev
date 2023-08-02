<?php

namespace App\Security;

use Psr\Log\LoggerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use App\Entity\User;

class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private $tokenManager;
    private $logger;

    public function __construct(JWTTokenManagerInterface $tokenManager, LoggerInterface $logger)
    {
        $this->tokenManager = $tokenManager;
        $this->logger = $logger;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {

        try {
            $user = $token->getUser();
            if (!$user instanceof User) {
                throw new \RuntimeException('User must be an instance of App\Entity\User.');
            }
            $token = $this->tokenManager->create($user, ['id' => $user->getId()]);
            return new JsonResponse(['id' => $user->getId(), 'token' => $token]);
        } catch (\Exception $e) {
            $this->logger->error('AuthenticationSuccessHandler: Error flagged during token generation.', ['exception' => $e]);
            throw $e;
        }
    }
}