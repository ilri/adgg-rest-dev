<?php

namespace App\Tests\Command;

use App\DataFixtures\AnimalEventFixtures;
use Doctrine\Common\DataFixtures\ReferenceRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class LactationFinderCommandTest extends KernelTestCase
{
    use FixturesTrait;

    /**
     * @var ReferenceRepository
     */
    private $fixtures;

    public function setUp(): void
    {
        parent::setUp();

        $this->fixtures = $this->loadFixtures([
            AnimalEventFixtures::class,
        ])->getReferenceRepository();
    }

    /**
     * @see https://symfony.com/doc/current/console.html#testing-commands
     */
    public function testExecute()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('adgg:assign-lactation-to-milking-event');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $output = $commandTester->getDisplay();
        //10 milking events without a lactation id have been created in the fixtures
        $this->assertStringContainsString('The number of lactations assigned is: 10', $output);
    }
}
