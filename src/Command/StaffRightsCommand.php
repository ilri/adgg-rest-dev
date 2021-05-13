<?php

namespace App\Command;

use App\Entity\CoreMasterList;
use App\Entity\CoreMasterListType;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StaffRightsCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var string
     */
    protected static $defaultName = 'adgg:staffrights';

    /**
     * @var string
     */
    protected static $defaultDescription = 'Get staff rights';

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
        $output->writeln([
            'Retrieves staff rights from the database',
            '========================================',
            ''
        ]);

        $users = $this->getUsersWithActivities();

        foreach ($users as $user) {
            $output->writeln(json_encode($user->getAdditionalAttributes()['728']));

            foreach ($user->getAdditionalAttributes()['728'] as $key) {
                $output->writeln($user->getId());
                $result = $this->getMasterList($key);
                $order = $this->getActivityOrder($result);
                $output->writeln($result->getValue());
                $output->writeln($result->getLabel());
                $output->writeln($order);
                $output->writeln($user->getAdditionalAttributes()['730']);
            }
        }

//        $io = new SymfonyStyle($input, $output);
//        $arg1 = $input->getArgument('arg1');
//
//        if ($arg1) {
//            $io->note(sprintf('You passed an argument: %s', $arg1));
//        }
//
//        if ($input->getOption('option1')) {
//            // ...
//        }
//
//        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

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

    private function getUsersWithActivities(): array
    {
        $users = $this->getUsers();

        return array_filter($users, function (User $user) {
            return array_key_exists('728', $user->getAdditionalAttributes());
        });
    }

    private function getAllMasterList(): array
    {
        $listType = $this->getListType();

        return $this->em->getRepository(CoreMasterList::class)->findBy(
            [
                'listType' => $listType,
            ]
        );
    }

    /**
     * @param string $key
     * @return CoreMasterList
     */
    private function getMasterList(string $key): CoreMasterList
    {
        $masterList = $this->getAllMasterList();

        return current(array_filter($masterList, function($item) use ($key) {
            return $item->getValue() == $key;
        }));
    }

    /**
     * @return CoreMasterListType
     */
    private function getListType(): CoreMasterListType
    {
        return $this->em->getRepository(CoreMasterListType::class)
            ->findOneBy(['id' => 20004]);
    }

    /**
     * @param CoreMasterList $item
     * @return int
     */
    private function getActivityOrder(CoreMasterList $item): int
    {
        $masterList = $this->getAllMasterList();

        return array_search($item, $masterList) + 1;
    }
}
