<?php


namespace App\Tests\API;

use App\Tests\AuthApiTestCase;

class FarmTest extends AuthApiTestCase
{
    public function testGetCollection()
    {
        $response = $this->client->request('GET', '/api/farms');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request('GET', '/api/farms', ['auth_bearer' => $this->token]);
        $this->assertResponseIsSuccessful();
        $json = $response->toArray();
        // we have created 10 animal events in the fixtures
        $this->assertEquals(10, $json['hydra:totalItems']);
    }

    public function testPostCollection()
    {
        $response = $this->client->request('POST', '/api/farms');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request(
            'POST',
            '/api/farms',
            [
                'auth_bearer' => $this->token,
                'json' => [
                    'name' => 'My little farm',
                    'farmerIsHhHead' => true,
                    'isActive' => true,
                    'isDeleted' => false
                ]
            ]
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $json = $response->toArray();
        $this->assertArrayHasKey('name', $json);
        $this->assertArrayHasKey('uuid', $json);
        $this->assertStringStartsWith(sprintf('%s-', $this->user->getUsername()), $json['uuid']);
        $this->assertArrayHasKey('createdBy', $json);
        $this->assertEquals($this->user->getId(), $json['createdBy']);
    }

    public function testGetItem()
    {
        $response = $this->client->request('GET', '/api/farms/1');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request('GET', '/api/farms/1', ['auth_bearer' => $this->token]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $json = $response->toArray();
        $this->assertArrayHasKey('name', $json);
        $this->assertArrayHasKey('uuid', $json);
    }

    public function testPutItem()
    {
        $response = $this->client->request('PUT', '/api/farms/1');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request(
            'PUT',
            '/api/farms/1',
            [
                'auth_bearer' => $this->token,
                'json' => [
                    'name' => 'My big farm',
                    'farmerIsHhHead' => true,
                    'isActive' => true,
                    'isDeleted' => false
                ]
            ]
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $json = $response->toArray();
        $this->assertArrayHasKey('name', $json);
        $this->assertEquals('My big farm', $json['name']);
        $this->assertArrayHasKey('updatedBy', $json);
        $this->assertEquals($this->user->getId(), $json['updatedBy']);
        $this->assertArrayHasKey('updatedAt', $json);
    }

    public function testDeleteItem()
    {
        $response = $this->client->request('DELETE', '/api/farms/1');
        $this->assertResponseStatusCodeSame(405);

        $response = $this->client->request('DELETE', '/api/farms/1', ['auth_bearer' => $this->token]);
        $this->assertResponseStatusCodeSame(405);
    }

    public function testPatchItem()
    {
        $response = $this->client->request('PATCH', '/api/farms/1');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request(
            'PATCH',
            '/api/farms/1',
            [
                'auth_bearer' => $this->token,
                'headers' => [
                    'content-type' => 'application/merge-patch+json'
                ],
                'json' => [
                    'farmerIsHhHead' => false
                ]
            ]
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $json = $response->toArray();
        $this->assertArrayHasKey('farmerIsHhHead', $json);
        $this->assertEquals(false, $json['farmerIsHhHead']);
        $this->assertArrayHasKey('updatedBy', $json);
        $this->assertEquals($this->user->getId(), $json['updatedBy']);
        $this->assertArrayHasKey('updatedAt', $json);
    }
}