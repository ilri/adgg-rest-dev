<?php


namespace App\Tests\API;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\AuthUsers;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;


class AnimalEventTest extends ApiTestCase
{
    use ReloadDatabaseTrait;

    private $client;
    private $token;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = self::createClient();

        $user = new AuthUsers();
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
        $response = $this->client->request('POST', '/authentication_token', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => 'test',
                'password' => '$3CR3T',
            ],
        ]);
        $json = $response->toArray();

        $this->token = $json['token'];
    }

    public function testGetCollection()
    {
        $response = $this->client->request('GET', '/api/core_animal_events');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request('GET', '/api/core_animal_events', ['auth_bearer' => $this->token]);
        $this->assertResponseIsSuccessful();
    }
}