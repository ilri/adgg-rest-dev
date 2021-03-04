<?php

namespace App\Command;

use App\Entity\OdkForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OdkFormCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var string
     */
    protected static $defaultName = 'adgg:retrieve-odk-forms';

    /**
     * OdkFormCommand constructor.
     * @param EntityManagerInterface $em
     * @param string|null $name
     */
    public function __construct(EntityManagerInterface $em, string $name = null)
    {
        $this->em = $em;
        parent::__construct($name);
    }

    /**
     * Configure
     */
    protected function configure()
    {
        $this
            ->setDescription('Retrieves ODK forms')
            ->setHelp('Retrieves ODK forms from the database')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Retrieves ODK forms from the database',
            '=====================================',
            ''
        ]);

        $odkFormRecords = $this->em->getRepository(OdkForm::class)
            ->findBy(['isProcessed' => true, 'hasErrors' => true], null, 10);

        foreach ($odkFormRecords as $record) {
            $output->writeln([
                sprintf('ODK form id is: %s', $record->getId()),
                sprintf('ODK form uuid is: %s', $record->getFormUuid()),
                sprintf('ODK form is processed: %s', $record->getIsProcessed()),
                sprintf('ODK form has errors: %s', $record->getHasErrors()),
                sprintf('ODK form error message is: %s', $record->getErrorMessage()),
            ]);
        }
        return Command::SUCCESS;
    }
}