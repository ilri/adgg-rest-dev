<?php


namespace App\Tests\API;

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

    public function testPostCollection()
    {
        $response = $this->client->request('POST', '/api/core_animal_events');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request(
            'POST',
            '/api/core_animal_events',
            [
                'auth_bearer' => $this->token,
                'json' => [
                    'animal' => '/api/core_animals/1',
                    'eventType' => 1,
                    'countryId' => 1,
                    'uuid' => '00001',
                    'eventDate' => '2020-02-03',
                    'additionalAttributes' => [
                        59 => '10',
                        61 => '12',
                        62 => '10',
                    ],
                ]
            ]
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }
}