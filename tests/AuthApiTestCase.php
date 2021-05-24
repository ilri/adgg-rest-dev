<?php


namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\DataFixtures\{
    AnimalEventFixtures,
    AnimalFixtures,
    CountryFixtures,
    FarmFixtures,
    FarmMetadataFixtures,
    HerdFixtures,
    TableAttributeFixtures,
    UserFixtures
};
use App\Entity\User;
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
     * @var User
     */
    protected $user;

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
            CountryFixtures::class,
            FarmFixtures::class,
            FarmMetadataFixtures::class,
            AnimalFixtures::class,
            AnimalEventFixtures::class,
            HerdFixtures::class,
            TableAttributeFixtures::class,
        ])->getReferenceRepository();

        $this->jwtManager = self::$container->get('lexik_jwt_authentication.jwt_manager');

        $this->user = $this->fixtures->getReference('test_user');
        $this->token = $this->jwtManager->create($this->user);
    }
}