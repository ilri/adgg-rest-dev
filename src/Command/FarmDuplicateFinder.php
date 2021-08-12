<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FarmDuplicateFinder extends Command
{
    private const PAGE_SIZE = 100;
    private const OUTPUT_DIR = '/output/farm_duplicates/';
    private const OUTPUT_FILE = 'farm_duplicates_log_%s.csv';

    /**
     * @var string
     */
    protected static $defaultName = 'adgg:find-duplicate-farms';

    /**
     * @var string
     */
    protected static $defaultDescription = 'Finds and merges duplicated farm resources.';

    /**
     * @var string
     */
    protected static $defaultHelp = 'Creates a CSV file containing duplicated farm resources, which have been located using name and phone number attributes.';

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * FarmDuplicateFinder constructor.
     * @param EntityManagerInterface $em
     * @param string|null $name
     */
    public function __construct(EntityManagerInterface $em, string $name = null)
    {
        $this->em = $em;
        $this->em->getConnection()->getConfiguration()->setSQLLogger(null);
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setDescription(self::$defaultDescription);
        $this->setHelp(self::$defaultHelp);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title(self::$defaultDescription);

        return Command::SUCCESS;
    }
}
