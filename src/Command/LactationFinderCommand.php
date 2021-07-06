<?php

namespace App\Command;

use App\Entity\AnimalEvent;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use League\Csv\CannotInsertRecord;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use League\Csv\Writer;

final class LactationFinderCommand extends Command
{
    private const PAGE_SIZE = 100;
    private const OUTPUT_DIR = '/output/lactation_finder/';
    private const OUTPUT_FILE = 'lactation_log_%s.csv';

    /**
     * @var string
     */
    protected static $defaultName = 'adgg:assign-lactation-to-milking-event';

    /**
     * @var string
     */
    protected static $defaultDescription = 'Finds and assigns a lactation to orphaned milking events';

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @var string
     */
    private $projectDir;

    /**
     * @var array
     */
    private $output;

    /**
     * LactationFinderCommand constructor.
     * @param EntityManagerInterface $em
     * @param string $projectDir
     * @param string|null $name
     */
    public function __construct(EntityManagerInterface $em, string $projectDir, string $name = null)
    {
        $this->em = $em;
        $this->projectDir = $projectDir;
        $this->output = [];
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
        ;
    }

    /**
     * Retrieves and processes all orphaned milking events
     * iteratively, limited by the page size constant.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Find and assign a lactation to orphaned milking events');

        $animalEventRepository = $this->em->getRepository(AnimalEvent::class);
        $paginator = new Paginator($animalEventRepository->findOrphanedMilkingEvents(), false);

        $offset = 0;

        $io->progressStart($paginator->count());
        while ($offset < $paginator->count()) {
            $page = new Paginator(
                $animalEventRepository->findOrphanedMilkingEvents(
                    $offset,
                    self::PAGE_SIZE
                ),
                false
            );
            foreach ($page as $record) {
                $this->processRecord($record);
                $io->progressAdvance();
            }
            $offset += self::PAGE_SIZE;
        }
        $io->progressFinish();

        try {
            $this->logOutput();
        } catch (CannotInsertRecord $e) {
            $io->error($e->getRecord());
            $io->error('The CSV file could not be written.');
            die;
        }

        return Command::SUCCESS;
    }

    private function insertIntoOutput(array $item): void
    {
        $this->output[] = $item;
    }

    /**
     * Sets the lactation ID on an orphaned milking event record,
     * if a corresponding calving event exists.
     *
     * Logs the milking event ID, lactation ID and whether the assignment
     * has been successful.
     *
     * @param AnimalEvent $record
     */
    private function processRecord (AnimalEvent $record): void
    {
        $lastCalvingEvent = $record->getAnimal()->getLastCalving();
        $lactationId = $lastCalvingEvent ? $lastCalvingEvent->getId() : null;
        $assigned = 'Y';
        $lactationId ? $record->setLactationId($lactationId) : $assigned = 'N';

        $this->insertIntoOutput([$record->getId(), $lactationId ?? 'Not found', $assigned]);
    }

    /**
     * @throws CannotInsertRecord
     */
    private function logOutput(): void
    {
        $header = [
            'milking_event_id',
            'last_calving_event_id',
            'assigned',
        ];
        $now = new \DateTime();

        $writer = Writer::createFromPath(
            sprintf($this->projectDir.self::OUTPUT_DIR.self::OUTPUT_FILE, $now->getTimestamp()),
            'w'
        );
        $writer->insertOne($header);
        $writer->insertAll($this->output);
    }
}
