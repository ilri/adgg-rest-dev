<?php

namespace App\Tests\API;

use App\Tests\AuthApiTestCase;

class FarmMetadataTest extends AuthApiTestCase
{
    public function testGetCollection()
    {
        $response = $this->client->request('GET', '/api/farm_metadata');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request('GET', '/api/farms', ['auth_bearer' => $this->token]);
        $this->assertResponseIsSuccessful();
        $json = $response->toArray();
        // we have created 10 farm metadata entries in the fixtures
        $this->assertEquals(10, $json['hydra:totalItems']);
    }

    public function testPostCollection()
    {
        $response = $this->client->request('POST', '/api/farm_metadata');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request(
            'POST',
            '/api/farm_metadata',
            [
                'auth_bearer' => $this->token,
                'json' => [
                    'type' => 1,
                    'farm' => '/api/farms/1'
                ]
            ]
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $json = $response->toArray();
        $this->assertArrayHasKey('type', $json);
        $this->assertArrayHasKey('farm', $json);
        $this->assertArrayHasKey('createdBy', $json);
        $this->assertEquals($this->user->getId(), $json['createdBy']);
    }

    public function testGetItem()
    {
        $response = $this->client->request('GET', '/api/farm_metadata/1');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request('GET', '/api/farm_metadata/1', ['auth_bearer' => $this->token]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $json = $response->toArray();
        $this->assertArrayHasKey('type', $json);
        $this->assertArrayHasKey('farm', $json);
    }

    public function testPutItem()
    {
        $response = $this->client->request('PUT', '/api/farm_metadata/1');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request(
            'PUT',
            '/api/farm_metadata/1',
            [
                'auth_bearer' => $this->token,
                'json' => [
                    'type' => 1,
                    'farm' => '/api/farms/1'
                ]
            ]
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $json = $response->toArray();
        $this->assertArrayHasKey('type', $json);
        $this->assertEquals(1, $json['type']);
        $this->assertArrayHasKey('updatedBy', $json);
        $this->assertEquals($this->user->getId(), $json['updatedBy']);
        $this->assertArrayHasKey('updatedAt', $json);
    }

    public function testDeleteItem()
    {
        $response = $this->client->request('DELETE', '/api/farm_metadata/1');
        $this->assertResponseStatusCodeSame(405);

        $response = $this->client->request('DELETE', '/api/farm_metadata/1', ['auth_bearer' => $this->token]);
        $this->assertResponseStatusCodeSame(405);
    }

    public function testPatchItem()
    {
        $response = $this->client->request('PATCH', '/api/farm_metadata/1');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request(
            'PATCH',
            '/api/farm_metadata/1',
            [
                'auth_bearer' => $this->token,
                'headers' => [
                    'content-type' => 'application/merge-patch+json'
                ],
                'json' => [
                    'type' => 5
                ]
            ]
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $json = $response->toArray();
        $this->assertArrayHasKey('type', $json);
        $this->assertEquals(5, $json['type']);
        $this->assertArrayHasKey('updatedBy', $json);
        $this->assertEquals($this->user->getId(), $json['updatedBy']);
        $this->assertArrayHasKey('updatedAt', $json);
    }
}