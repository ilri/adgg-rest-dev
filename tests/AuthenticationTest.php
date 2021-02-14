<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\User;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;

class AuthenticationTest extends AuthApiTestCase
{
    use ReloadDatabaseTrait;

    public function testLogin(): void
    {
        $client = self::createClient();

        $user = new User();
        $user->setName('Test User');
        $user->setUsername('test');
        $user->setPasswordHash(
            self::$container->get('security.password_encoder')->encodePassword($user, '$3CR3T')
        );
        $user->setCreatedAt(new \DateTime());
        $user->setUuid('uuid');

        $manager = self::$container->get('doctrine')->getManager();
        $manager->persist($user);
        $manager->flush();

        // retrieve a token
        $response = $client->request('POST', '/authentication_token', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => 'test',
                'password' => '$3CR3T',
            ],
        ]);

        $json = $response->toArray();
        $this->assertResponseIsSuccessful();
        $this->assertArrayHasKey('token', $json);

        // test not authorized
        $client->request('GET', '/api');
        $this->assertResponseStatusCodeSame(401);

        // test authorized
        $client->request('GET', '/api', ['auth_bearer' => $json['token']]);
        $this->assertResponseIsSuccessful();
    }
}