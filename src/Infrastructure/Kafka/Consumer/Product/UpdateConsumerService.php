<?php

namespace App\Infrastructure\Kafka\Consumer\Product;

use App\DTO\Product\KafkaMessageDTO;
use App\Infrastructure\Kafka\Consumer\AbstractConsumerService;
use RdKafka\Message;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateConsumerService extends AbstractConsumerService
{
    protected function handleMessage(Message $message, OutputInterface $output): void
    {
        try {
            /** @var KafkaMessageDTO $dto */
            $dto = $this->serializer->deserialize($message->payload, KafkaMessageDTO::class, 'json');
            $output->writeln("✅ Processed product update message.");
            $this->processorService->process($dto);
        } catch (\Throwable $e) {
            $output->writeln("❌ Failed to handle product update message: " . $e->getMessage());
        }
    }
}
