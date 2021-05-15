<?php

namespace App\Command;

use App\Entity\{
    MasterList,
    MasterListType,
    TableAttribute,
    User
};
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class StaffRightsCommand extends Command
{
    const ACTIVITY_TYPE_ID = '728';
    const STAFF_HASRIGHT_ID = '730';

    /**
     * @var EntityManagerInterface
     */
    private $em;

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
            //->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            //->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->writeln([
            'Generate a CSV file with staff rights',
            '=====================================',
            ''
        ]);
        $io->writeln([
            'Fetching data from the database',
            '',
        ]);

        $start = microtime(true);
        $result = $this->generateResult($io);
        dump(microtime(true) - $start);

        $this->generateOutput($result);

        $io->success('A CSV file with staff rights has been created.');

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
    private function getActivityType(): MasterListType
    {
        $tableAttribute = $this->em->getRepository(TableAttribute::class)
            ->findOneBy(['id' => self::ACTIVITY_TYPE_ID]);

        return $tableAttribute->getListType();
    }

    private function getAllMasterListEntriesForActivityType(): array
    {
        $activityType = $this->getActivityType();

        return $this->em->getRepository(MasterList::class)->findBy(
            [
                'listType' => $activityType,
            ]
        );
    }

    /**
     * @param string $key
     * @return MasterList
     */
    private function getSingleMasterListEntry(array $masterListEntries, string $key): MasterList
    {
        //$masterListEntries = $this->getAllMasterListEntriesForActivityType();

        return current(array_filter($masterListEntries, function($item) use ($key) {
            return $item->getValue() == $key;
        }));
    }

    /**
     * @param MasterList $item
     * @return int
     */
    private function getActivityOrder(MasterList $item): int
    {
        $masterList = $this->getAllMasterListEntriesForActivityType();

        return array_search($item, $masterList) + 1;
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
        $result = [];

        $io->writeln(sprintf('Calculating staff rights for %s users', count($users)));
        $io->progressStart(count($users));
        foreach ($users as $user) {
            $additionalAttributes = $user->getAdditionalAttributes();
            $activityTypeKeys = $additionalAttributes[self::ACTIVITY_TYPE_ID];
            $staffHasRight = $additionalAttributes[self::STAFF_HASRIGHT_ID];
            foreach ($activityTypeKeys as $key) {
                $entry = [];
                $entry[] = $user->getId();
                $masterListEntry = $this->getSingleMasterListEntry($masterListEntries, $key);
                $order = $this->getActivityOrder($masterListEntry);
                $entry[] = $masterListEntry->getValue();
                $entry[] = $masterListEntry->getLabel();
                $entry[] = $order;
                $entry[] = $staffHasRight;
                $result[] = $entry;
            }
            $io->progressAdvance();
        }
        $io->progressFinish();

        return $result;
    }

    /**
     * @param array $result
     */
    private function generateOutput(array $result): void
    {
        $columnHeaders = [
            'staff_code',
            'activity_code',
            'activity_name',
            'activity_order',
            'staff_hasright',
        ];
        $fp = fopen('staff_rights.csv', 'w');
        fputcsv($fp, $columnHeaders);

        foreach ($result as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);
    }
}
