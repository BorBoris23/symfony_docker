<?php

namespace App\Service\Kafka;

use Symfony\Component\Console\Output\OutputInterface;

interface ConsumerServiceInterface
{
    public function consume(OutputInterface $output): void;
}
