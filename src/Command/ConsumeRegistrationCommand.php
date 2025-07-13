<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'kafka:consume:user_registration',
    description: 'Consume Kafka registration messages'
)]
class ConsumeRegistrationCommand extends AbstractConsumeCommand
{
    protected function configure(): void
    {
        $this->setDescription('Starts a Kafka consumer for user_registration_notifications');
    }
}
