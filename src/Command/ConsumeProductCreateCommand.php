<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'kafka:consume:product_create',
    description: 'Consume product create Kafka messages',
)]
class ConsumeProductCreateCommand extends AbstractConsumeCommand
{
    protected function configure(): void
    {
        $this->setDescription('Starts a Kafka consumer for product_create_notifications');
    }
}
