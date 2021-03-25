<?php


namespace App\Tests\API;

use App\DataFixtures\AnimalFixtures;
use App\Tests\AuthApiTestCase;

class AnimalTest extends AuthApiTestCase
{
    public function testGetCollection()
    {
        $response = $this->client->request('GET', '/api/animals');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request('GET', '/api/animals', ['auth_bearer' => $this->token]);
        $this->assertResponseIsSuccessful();
        $json = $response->toArray();
        // we have created 10 animal events in the fixtures
        $this->assertEquals(10, $json['hydra:totalItems']);
    }

    public function testPostCollection()
    {
        $response = $this->client->request('POST', '/api/animals');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request(
            'POST',
            '/api/animals',
            [
                'auth_bearer' => $this->token,
                'json' => [
                    'countryId' => 1,
                ]
            ]
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $json = $response->toArray();
        $this->assertArrayHasKey('countryId', $json);
    }

    public function testGetItem()
    {
        $response = $this->client->request('GET', '/api/animals/1');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request('GET', '/api/animals/1', ['auth_bearer' => $this->token]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $json = $response->toArray();
        $this->assertArrayHasKey('countryId', $json);
    }

    public function testPutItem()
    {
        $response = $this->client->request('PUT', '/api/animals/1');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request(
            'PUT',
            '/api/animals/1',
            [
                'auth_bearer' => $this->token,
                'json' => [
                    'countryId' => 1,
                    'name' => 'Kimani',
                ]
            ]
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $json = $response->toArray();
        $this->assertArrayHasKey('name', $json);
        $this->assertEquals('Kimani', $json['name']);
    }

    public function testDeleteItem()
    {
        $response = $this->client->request('DELETE', '/api/animals/1');
        $this->assertResponseStatusCodeSame(405);

        $response = $this->client->request('DELETE', '/api/animals/1', ['auth_bearer' => $this->token]);
        $this->assertResponseStatusCodeSame(405);
    }

    public function testPatchItem()
    {
        $response = $this->client->request('PATCH', '/api/animals/1');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request(
            'PATCH',
            '/api/animals/1',
            [
                'auth_bearer' => $this->token,
                'headers' => [
                    'content-type' => 'application/merge-patch+json'
                ],
                'json' => [
                    'name' => 'Milka'
                ]
            ]
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $json = $response->toArray();
        $this->assertArrayHasKey('name', $json);
        $this->assertEquals('Milka', $json['name']);
    }

    public function testCountryIdFilter()
    {
        // 5 entries should be retrieved for countryId=1
        $response = $this->client->request('GET', '/api/animals?countryId=1', ['auth_bearer' => $this->token]);
        $this->assertResponseIsSuccessful();
        $json = $response->toArray();
        $this->assertEquals(5, $json['hydra:totalItems']);

        // 3 entries should be retrieved for countryId=2
        $response = $this->client->request('GET', '/api/animals?countryId=2', ['auth_bearer' => $this->token]);
        $this->assertResponseIsSuccessful();
        $json = $response->toArray();
        $this->assertEquals(3, $json['hydra:totalItems']);

        // 2 entries should be retrieved for countryId=2
        $response = $this->client->request('GET', '/api/animals?countryId=3', ['auth_bearer' => $this->token]);
        $this->assertResponseIsSuccessful();
        $json = $response->toArray();
        $this->assertEquals(2, $json['hydra:totalItems']);
    }
}