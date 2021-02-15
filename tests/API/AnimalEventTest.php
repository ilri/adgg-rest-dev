<?php


namespace App\Tests\API;

use App\Tests\AuthApiTestCase;

class AnimalEventTest extends AuthApiTestCase
{
    public function testGetCollection()
    {
        $response = $this->client->request('GET', '/api/animal_events');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request('GET', '/api/animal_events', ['auth_bearer' => $this->token]);
        $this->assertResponseIsSuccessful();
        $json = $response->toArray();
        // we have created 10 animal events in the fixtures
        $this->assertEquals(10, $json['hydra:totalItems']);
    }

    public function testPostCollection()
    {
        $response = $this->client->request('POST', '/api/animal_events');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request(
            'POST',
            '/api/animal_events',
            [
                'auth_bearer' => $this->token,
                'json' => [
                    'animal' => '/api/animals/1',
                    'eventType' => 2, // milking
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

    public function testGetItem()
    {
        $response = $this->client->request('GET', '/api/animal_events/1');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request('GET', '/api/animal_events/1', ['auth_bearer' => $this->token]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $json = $response->toArray();
        $this->assertArrayHasKey('animal', $json);
        $this->assertArrayHasKey('eventType', $json);
        $this->assertArrayHasKey('countryId', $json);
        $this->assertArrayHasKey('uuid', $json);
    }
}