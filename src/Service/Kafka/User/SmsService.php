<?php

namespace App\Service\Kafka\User;

class SmsService
{
    public function send(string $phone, string $message): void
    {
        echo "📱 [SIMULATED SMS] Отправлено на номер {$phone}: {$message}\n";
    }
}
