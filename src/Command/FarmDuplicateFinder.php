<?php

namespace App\Command;

use App\Entity\Animal;
use App\Entity\Farm;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
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
        $farmRepository = $this->em->getRepository(Farm::class);

        $farmPaginator = new Paginator($farmRepository->findDuplicatedFarms(), false);

        $io->progressStart($farmPaginator->count());
        $offset = 0;

        while ($offset < $farmPaginator->count()) {
            $farmPaginator = new Paginator(
                $farmRepository->findDuplicatedFarms($offset, self::PAGE_SIZE), false
            );

            foreach ($farmPaginator as $farmRecord) {
                $farmDuplicates = $this->returnGroupOfDuplicates($farmRecord) ?? null;
                $this->mergeFarmAnimals($farmDuplicates);
                $io->progressAdvance();
            }
            $offset += self::PAGE_SIZE;
        }
        $io->progressFinish();
        return Command::SUCCESS;
    }

    /**
     * Searches for a farm duplicates.
     *
     * @param Farm $farm
     * @return array|null
     */
    private function returnGroupOfDuplicates(Farm $farm): ?array
    {
        $farmRepository = $this->em->getRepository(Farm::class);

        return $farmRepository->findGroupOfDuplicates($farm);
    }

    /**
     * Filters the array of grouped farm duplicates,
     * and selects the record which has been created first.
     *
     * Subsequently iterates through all farm duplicates and
     * re-assigns animal records to the primary farm.
     *
     * @param $farmDuplicates
     */
    private function mergeFarmAnimals($farmDuplicates): void
    {
        //Farm that was created first
        $primaryFarm = $farmDuplicates[0];

        foreach($farmDuplicates as $farmDuplicate){
            $farmId = $farmDuplicate->getId();
            $duplicatedAnimals = $this->em->getRepository(Animal::class)->findBy(['farm' => $farmId]);

            if (!empty($duplicatedAnimals)) {
                foreach($duplicatedAnimals as $duplicatedAnimal){
                    $duplicatedAnimal->setFarm($primaryFarm);
                }
            }
        }
    }
}
