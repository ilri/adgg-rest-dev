<?php

namespace App\Command;

use App\Entity\AnimalEvent;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use League\Csv\CannotInsertRecord;
use League\Csv\Writer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


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
    private string $projectDir;

    /**
     * @var Writer $writer
     */
    private Writer $writer;

    /**
     * @var int
     */
    private int $assignedLactations;

    /**
     * @var
     */
    private $io;

    /**
     * LactationFinderCommand constructor.
     * @param EntityManagerInterface $em
     * @param string $projectDir
     * @param string|null $name
     * @throws CannotInsertRecord
     */
    public function __construct(EntityManagerInterface $em, string $projectDir, string $name = null, $assignedLactations = 0)
    {
        $this->em = $em;
        $this->projectDir = $projectDir;
        $this->writer = $this->createCsv();
        $this->assignedLactations = 0;
        parent::__construct($name);
    }

    /**
     * Initialises the Csv file used for appending processing results.
     * @throws CannotInsertRecord
     */
    private function createCsv(): Writer
    {
        $header = [
            'milking_event_id',
            'last_calving_event_id',
            'assigned',
        ];
        $now = new \DateTime;

        $writer = Writer::createFromPath(
            sprintf($this->projectDir.self::OUTPUT_DIR.self::OUTPUT_FILE, $now->format('Y_m_d_H_i_s')),
            'w'
        );

        $writer->insertOne($header);

        return $writer;
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription);
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
        $this->io = new SymfonyStyle($input, $output);
        $this->io->title('Find and assign a lactation to orphaned milking events');

        $animalEventRepository = $this->em->getRepository(AnimalEvent::class);
        $paginator = new Paginator($animalEventRepository->findOrphanedMilkingEvents(), false);

        $offset = 0;

        $this->io->info('Records are now being retrieved from the database.');
        $this->io->progressStart($paginator->count());
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
                $this->io->progressAdvance();
            }
            //$this->em->flush();
            $this->em->clear();
            $offset += self::PAGE_SIZE;
        }
        $this->io->progressFinish();
        $this->io->info('All orphaned milking events have now been processed.');
        $this->io->info(sprintf('The number of lactations assigned is: %d', $this->assignedLactations));

        return Command::SUCCESS;
    }

    /**
     * Sets the lactation ID on an orphaned milking event record,
     * if a calving event for that milking event exists.
     *
     * Logs the milking event ID, lactation ID and whether the assignment
     * has been successful.
     *
     * @param AnimalEvent $record
     */
    private function processRecord(AnimalEvent $record): void
    {
        $lactationId = $this->retrieveLactationId($record);
        $assigned = 'N';

        if ($lactationId) {
            $record = $record->setLactationId($lactationId);
            //$this->em->persist($record);
            $assigned = 'Y';
            $this->assignedLactations += 1;
        }

        $this->appendToCSV([$record->getId(), $lactationId ?? 'Not found', $assigned]);
    }

    /**
     * Retrieves the most recent calving event for a given milking record
     * and, if present, checks whether it occurred no more than 1000 days
     * prior. Only returns a lactation Id if both these conditions are met.
     *
     *
     * @param AnimalEvent $record
     * @return int|null
     */
    private function retrieveLactationId(AnimalEvent $record): ?int
    {
        $lastCalvingEvent = $this
            ->em
            ->getRepository(AnimalEvent::class)
            ->findLastCalvingEvent($record)
        ;

        if (!$lastCalvingEvent) {
            return null;
        }

        $lastCalvingEventDate = $lastCalvingEvent->getEventDate();
        $milkingEventDate = $record->getEventDate();
        $interval = date_diff($lastCalvingEventDate, $milkingEventDate);

        return $interval->days <= 1000 ? $lastCalvingEvent->getId() : null;
    }

    /**
     * Appends a record to an existing Csv file.
     */
    private function appendToCSV(array $item): void
    {

        $writer = $this->writer;
        try {
            $writer->insertOne($item);
        } catch (CannotInsertRecord $e) {
            $this->io->error('Record could not be appended to Csv file.');
        }
    }
}
