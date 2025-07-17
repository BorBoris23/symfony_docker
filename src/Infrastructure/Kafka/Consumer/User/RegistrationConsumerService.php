<?php

declare(strict_types=1);

namespace App\Infrastructure\Kafka\Consumer\User;
use App\DTO\Registration\KafkaMessageDTO;
use App\Infrastructure\Kafka\Consumer\AbstractConsumerService;
use RdKafka\Message;
use Symfony\Component\Console\Output\OutputInterface;

class RegistrationConsumerService extends AbstractConsumerService
{
    protected function handleMessage(Message $message, OutputInterface $output): void
    {
        try {
            /** @var KafkaMessageDTO $dto */
            $dto = $this->serializer->deserialize($message->payload, KafkaMessageDTO::class, 'json');
            $output->writeln("✅ Processed message: ");
            $this->processorService->process($dto);
        } catch (\Throwable $e) {
            $output->writeln("❌ Failed to handle message: " . $e->getMessage());
        }
    }
}
