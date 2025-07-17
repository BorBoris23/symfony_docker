<?php

namespace App\Infrastructure\Kafka\Config;

final readonly class KafkaConsumerConfig
{
    public function __construct(
        public string $brokers,
        public string $topic,
        public string $groupId,
        public bool $autoCommit,
        public string $waitingMessage,
    ) {}
}
