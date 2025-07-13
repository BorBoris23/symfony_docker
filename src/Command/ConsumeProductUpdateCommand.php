<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'kafka:consume:product_update',
    description: 'Consume product update Kafka messages',
)]
class ConsumeProductUpdateCommand extends AbstractConsumeCommand
{
    protected function configure(): void
    {
        $this->setDescription('Starts a Kafka consumer for product_update_notifications');
    }
}
