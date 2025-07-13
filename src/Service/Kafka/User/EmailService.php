<?php

namespace App\Service\Kafka\User;

class EmailService
{
    public function send(string $email, string $message): void
    {
        echo "📧 Sending email to {$email}: {$message}\n";
    }
}
