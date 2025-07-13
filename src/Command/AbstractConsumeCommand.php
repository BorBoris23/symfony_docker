<?php

namespace App\Command;

use App\Service\Kafka\ConsumerServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractConsumeCommand extends Command
{
    public function __construct(
        private readonly ConsumerServiceInterface $consumerService
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Запускаем Kafka consumer...');
        $this->consumerService->consume($output);
        return Command::SUCCESS;
    }
}
