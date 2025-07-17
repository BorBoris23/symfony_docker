<?php

namespace App\Infrastructure\Kafka\Consumer;

use Symfony\Component\Console\Output\OutputInterface;

interface ConsumerServiceInterface
{
    public function consume(OutputInterface $output): void;
}
