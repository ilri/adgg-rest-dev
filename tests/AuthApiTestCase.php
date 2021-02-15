<?php


namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\DataFixtures\TestFixtures;
use App\DataFixtures\UserFixtures;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Liip\TestFixturesBundle\Test\FixturesTrait;


class AuthApiTestCase extends ApiTestCase
{
    use FixturesTrait;

    /**
     * @var \ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client
     */
    protected $client;

    /**
     * @var \Doctrine\Common\DataFixtures\ReferenceRepository
     */
    protected $fixtures;

    /**
     * @var JWTManager
     */
    private $jwtManager;

    /**
     * @var string
     */
    protected $token;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = self::createClient();

        $this->fixtures = $this->loadFixtures([
            UserFixtures::class,
            TestFixtures::class,
        ])->getReferenceRepository();

        $this->jwtManager = self::$container->get('lexik_jwt_authentication.jwt_manager');

        $user = $this->fixtures->getReference('test_user');
        $this->token = $this->jwtManager->create($user);
    }
}