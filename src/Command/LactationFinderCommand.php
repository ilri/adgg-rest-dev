<?php

namespace App\Command;

use App\Entity\AnimalEvent;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use League\Csv\Writer;

final class LactationFinderCommand extends Command
{
    private const PAGE_SIZE = 100;
    private const OUTPUT_FILE = 'lactation_log.csv';

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
     * LactationFinderCommand constructor.
     * @param EntityManagerInterface $em
     * @param string|null $name
     */
    public function __construct(EntityManagerInterface $em, string $name = null)
    {
        $this->em = $em;
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
        //$eventCount = $animalEventRepository->countOrphanedMilkingEvents();
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

        return Command::SUCCESS;
    }

    /**
     * Sets the lactation ID on an orphaned milking event record,
     * if a corresponding calving event exists.
     *
     * Logs the milking event ID, lactation ID and whether the assignment
     * has been successful.
     *
     * @param $record
     */
    private function processRecord ($record): void
    {
        $milkingEventId = $record->getId();
        $lastCalvingEvent = $record->getAnimal()->getLastCalving();
        $lactationId = $lastCalvingEvent ? $lastCalvingEvent->getId() : null;
        $assigned = true;

        $lactationId ? $record->setLactationId($lactationId) : $assigned = false;

        $this->logOutput([$milkingEventId, $lactationId, $assigned]);
    }

    /**
     * @param $output
     * @throws \League\Csv\CannotInsertRecord
     */
    private function logOutput($output): void
    {

        $header = [
            'milking_event_id',
            'last_calving_event_id',
            'assigned',
        ];

        $writer = Writer::createFromPath(self::OUTPUT_FILE, "w");
        $writer->insertOne($header);
        $writer->insertAll($output);
    }
}
