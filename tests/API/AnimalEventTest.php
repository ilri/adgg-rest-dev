<?php


namespace App\Tests\API;

use App\Entity\AuthUsers;
use App\Tests\AuthApiTestCase;

class AnimalEventTest extends AuthApiTestCase
{
    public function testGetCollection()
    {
        $response = $this->client->request('GET', '/api/core_animal_events');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request('GET', '/api/core_animal_events', ['auth_bearer' => $this->token]);
        $this->assertResponseIsSuccessful();
    }
}