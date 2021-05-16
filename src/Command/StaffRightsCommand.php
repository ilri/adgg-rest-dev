<?php

namespace App\Command;

use App\Entity\{
    MasterList,
    MasterListType,
    TableAttribute,
    User
};
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\{
    CannotInsertRecord,
    Exception as CsvException,
    Reader,
    Writer
};
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{
    InputInterface,
    InputOption
};
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class StaffRightsCommand extends Command
{
    const ACTIVITY_TYPE_ID = '728';
    const STAFF_HASRIGHT_ID = '730';
    const DATA_SOURCE = '/src/Data/activities_list.csv';
    const OUTPUT_DIR = '/public/bundles/app/output/';
    const OUTPUT_FILE = 'staff_rights.csv';

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var string
     */
    private $projectDir;

    /**
     * @var string
     */
    protected static $defaultName = 'adgg:get-staff-rights';

    /**
     * @var string
     */
    protected static $defaultDescription = 'Generate a CSV file with staff rights';

    /**
     * StaffRightsCommand constructor.
     * @param EntityManagerInterface $em
     * @param string $projectDir
     * @param string|null $name
     */
    public function __construct(EntityManagerInterface $em, string $projectDir, string $name = null)
    {
        $this->em = $em;
        $this->projectDir = $projectDir;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addOption(
                'output',
                'o',
                InputOption::VALUE_REQUIRED,
                'The name of the output CSV file',
                self::OUTPUT_FILE
            )
            //->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
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

        $io->title('Generate a CSV file with staff rights');
        $io->writeln([
            'Fetching data from the database',
            '',
        ]);

        $filename = $input->getOption('output');

        $result = $this->generateResult($io);

        try {
            $this->generateOutput($result, $filename);
        } catch (CannotInsertRecord $e) {
            $io->error($e->getRecord());
            $io->error('The CSV file could not be written.');
            die;
        }

        $io->success(sprintf('A CSV file %s has been created.', $filename));

        return Command::SUCCESS;
    }

    /**
     * @return array
     */
    private function getUsers(): array
    {
        $repo = $this->em->getRepository(User::class);

        return $repo
            ->createQueryBuilder('u')
            ->where('u.additionalAttributes IS NOT NULL')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return array
     */
    private function getUsersWithActivities(): array
    {
        $users = $this->getUsers();

        return array_filter($users, function (User $user) {
            return array_key_exists(self::ACTIVITY_TYPE_ID, $user->getAdditionalAttributes());
        });
    }

    /**
     * @return MasterListType
     */
    private function getMasterListType(): MasterListType
    {
        $tableAttribute = $this->em->getRepository(TableAttribute::class)
            ->findOneBy(['id' => self::ACTIVITY_TYPE_ID]);

        return $tableAttribute->getListType();
    }

    /**
     * @return MasterList[]
     */
    private function getAllMasterListEntriesForActivityType(): array
    {
        $activityType = $this->getMasterListType();

        return $this->em->getRepository(MasterList::class)->findBy(
            [
                'listType' => $activityType,
            ]
        );
    }

    /**
     * @param MasterList[] $masterListEntries
     * @param string $key
     * @return MasterList
     */
    private function getSingleMasterListEntry(array $masterListEntries, string $key): MasterList
    {
        return current(array_filter($masterListEntries, function($item) use ($key) {
            return $item->getValue() == $key;
        }));
    }

    /**
     * @throws CsvException
     */
    private function getActivitiesList(): array
    {
        $reader = Reader::createFromPath($this->projectDir.self::DATA_SOURCE);
        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();
        return iterator_to_array($records);
    }

    /**
     * @param string $key
     * @param array $activitiesList
     * @return array
     */
    private function getActivityValuesFromInputData(string $key, array $activitiesList): array
    {
        $index = array_search($key,array_column($activitiesList, 'activity_code'));
        $record = $activitiesList[$index + 1];
        return [
            'activity_type' => $record['activity_type'],
            'activity_order' => $record['activity_order'],
        ];
    }

    /**
     * @param SymfonyStyle $io
     * @return array
     */
    private function generateResult(SymfonyStyle $io): array
    {
        $users = $this->em->getRepository(User::class)
            ->findAllUsersWithAdditionalAttributeKey(self::ACTIVITY_TYPE_ID)
        ;
        $masterListEntries = $this->getAllMasterListEntriesForActivityType();
        try {
            $activitiesList = $this->getActivitiesList();
        } catch (CsvException $e) {
            $io->error($e);
            $io->error('The data input file for activities list could not be read.');
            die;
        }

        $result = [];

        $io->writeln(sprintf('Calculating staff rights for %s users', count($users)));
        $io->progressStart(count($users));
        foreach ($users as $user) {
            $additionalAttributes = $user->getAdditionalAttributes();
            $activityTypeKeys = $additionalAttributes[self::ACTIVITY_TYPE_ID];
            $staffHasRight = $additionalAttributes[self::STAFF_HASRIGHT_ID];
            foreach ($activityTypeKeys as $key) {
                $entry = [];
                $entry[] = $user->getId(); // staff_code
                $masterListEntry = $this->getSingleMasterListEntry($masterListEntries, $key);
                $entry[] = $masterListEntry->getValue(); // activity_code
                $entry[] = $masterListEntry->getLabel(); // activity_name
                $activityValues = $this->getActivityValuesFromInputData($key, $activitiesList);
                $entry[] = $activityValues['activity_type']; // activity_type
                $entry[] = $activityValues['activity_order']; // activity_order
                $entry[] = $staffHasRight; // staff_hasright
                $result[] = $entry;
            }
            $io->progressAdvance();
        }
        $io->progressFinish();

        return $result;
    }

    /**
     * @param array $result
     * @param string $filename
     * @throws CannotInsertRecord
     */
    private function generateOutput(array $result, string $filename): void
    {
        $header = [
            'staff_code',
            'activity_code',
            'activity_name',
            'activity_type',
            'activity_order',
            'staff_hasright',
        ];
        $writer = Writer::createFromPath($this->projectDir.self::OUTPUT_DIR.$filename, 'w');
        $writer->insertOne($header);
        $writer->insertAll($result);
    }
}
