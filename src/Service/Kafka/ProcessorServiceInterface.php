<?php

namespace App\Service\Kafka;

use App\DTO\KafkaMessageInterface;

interface ProcessorServiceInterface
{
    public function process(KafkaMessageInterface $dto): void;
}
