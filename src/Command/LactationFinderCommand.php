<?php

namespace App\Command;

use App\Entity\AnimalEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class LactationFinderCommand extends Command
{
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
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Find and assign a lactation to orphaned milking events');

        $orphanedMilkingEvents = $this
            ->em
            ->getRepository(AnimalEvent::class)
            ->findOrphanedMilkingEvents()
        ;

        foreach ($orphanedMilkingEvents as $record){

            $milkingEventId = $record->getId();
            $animal = $record->getAnimal();
            $lastCalvingEvent = $animal->getLastCalving();

            if(!$lastCalvingEvent){
                $output->writeln([
                    sprintf('No calving event associated with milking event: %s',
                        $milkingEventId,
                    )
                ]);
            } else {
                //Sets the lactation ID for previously orphaned milking event record
                $record->setLactationId($lastCalvingEvent->getId());

                $output->writeln([
                    sprintf('Calving event: %s assigned to milking event: %s',
                        $lastCalvingEvent->getId(),
                        $milkingEventId,
                    )
                ]);
            }
        }
        return Command::SUCCESS;
    }
}
