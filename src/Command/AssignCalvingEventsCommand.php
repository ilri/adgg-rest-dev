<?php

namespace App\Command;

use App\Entity\AnimalEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AssignCalvingEventsCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'adgg:assign-calving-events';

    /**
     * @var string
     */
    protected static $defaultDescription = 'Assigns orphaned milking events to their calving event';

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * AssignCalvingEventsCommand constructor.
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

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Assigns orphaned milking events to their calving event',
            '=====================================',
            ''
        ]);

        $orphanedMilkingEvents = $this->em->getRepository(AnimalEvent::class)
            ->findBy(['eventType' => 2, 'lactationId' => null], null, 10);

        foreach ($orphanedMilkingEvents as $milkingEventRecord){
            $milkingEventId = $milkingEventRecord->getId();
            $animal = $milkingEventRecord->getAnimal();
            $lastCalvingEvent = $animal->getLastCalving();

            if(!$lastCalvingEvent){
                $output->writeln([
                    sprintf('No calving event associated with milking event: %s',
                        $milkingEventId,
                    )
                ]);
            } else {
                //Sets the lactation ID for previously orphaned milking event record
                $milkingEventRecord->setLactationId($lastCalvingEvent->getId());

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
