<?php


namespace App\Tests\API;

use \App\Tests\AuthApiTestCase;

class HerdTest extends AuthApiTestCase
{
    public function testGetCollection()
    {
        $response = $this->client->request('GET', '/api/herds');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request('GET', '/api/herds', ['auth_bearer' => $this->token]);
        $this->assertResponseIsSuccessful();
        $json = $response->toArray();
        // we have created 10 animal events in the fixtures
        $this->assertEquals(10, $json['hydra:totalItems']);
    }

    public function testPostCollection()
    {
        $response = $this->client->request('POST', '/api/herds');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request(
            'POST',
            '/api/herds',
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
        $this->assertStringStartsWith(sprintf('%s-', $this->user->getUsername()), $json['uuid']);
        $this->assertArrayHasKey('createdBy', $json);
        $this->assertEquals($this->user->getId(), $json['createdBy']);
    }


    public function testGetItem()
    {
        $response = $this->client->request('GET', '/api/herds/1');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request('GET', '/api/herds/1', ['auth_bearer' => $this->token]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }

    public function testPutItem()
    {
        $response = $this->client->request('PUT', '/api/herds/1');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request(
            'PUT',
            '/api/herds/1',
            [
                'auth_bearer' => $this->token,
                'json' => [
                    'name' => 'herd 1',
                    'isActive' => true,
                    'isDeleted' => false
                ]
            ]
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $json = $response->toArray();
        $this->assertArrayHasKey('name', $json);
        $this->assertEquals('herd 1', $json['name']);
        $this->assertArrayHasKey('updatedBy', $json);
        $this->assertEquals($this->user->getId(), $json['updatedBy']);
        $this->assertArrayHasKey('updatedAt', $json);
    }

    public function testDeleteItem()
    {
        $response = $this->client->request('DELETE', '/api/herds/1');
        $this->assertResponseStatusCodeSame(405);

        $response = $this->client->request('DELETE', '/api/herds/1', ['auth_bearer' => $this->token]);
        $this->assertResponseStatusCodeSame(405);
    }

    public function testPatchItem()
    {
        $response = $this->client->request('PATCH', '/api/herds/1');
        $this->assertResponseStatusCodeSame(401);

        $response = $this->client->request(
            'PATCH',
            '/api/herds/1',
            [
                'auth_bearer' => $this->token,
                'headers' => [
                    'content-type' => 'application/merge-patch+json'
                ],
                'json' => [
                    'name' => 'herd 2',
                ]
            ]
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $json = $response->toArray();
        $this->assertArrayHasKey('name', $json);
        $this->assertEquals('herd 2', $json['name']);
        $this->assertArrayHasKey('updatedBy', $json);
        $this->assertEquals($this->user->getId(), $json['updatedBy']);
        $this->assertArrayHasKey('updatedAt', $json);
    }
}