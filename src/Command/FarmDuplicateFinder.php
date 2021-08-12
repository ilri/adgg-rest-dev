<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FarmDuplicateFinder extends Command
{
    protected static $defaultName = 'adgg:find-duplicate-farms';
    protected static $defaultDescription = 'Finds and merges duplicated farm resources.';
    protected static $defaultHelp = 'Creates a CSV file containing duplicated farm resources, which have been located using name and phone number attributes.';
    protected function configure(): void
    {
        $this->setDescription(self::$defaultDescription);
        $this->setHelp(self::$defaultHelp);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title(self::$defaultDescription);

        return Command::SUCCESS;
    }
}
