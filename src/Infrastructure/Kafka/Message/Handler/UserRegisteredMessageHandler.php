<?php

namespace App\Infrastructure\Kafka\Message\Handler;

use App\DTO\Registration\KafkaMessageDTO;
use App\Infrastructure\Kafka\Message\Command\User\RegisteredMessage;
use App\Infrastructure\Kafka\ProducerService;
use RdKafka\Exception;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class UserRegisteredMessageHandler
{
    private const string MESSAGE_TYPE_SMS = 'sms';

    public function __construct(
        private ProducerService $producerService,
        private string $userRegistrationTopic,
    ) {}

    /**
     * @throws Exception
     */
    public function __invoke(RegisteredMessage $message): void
    {
        $user = $message->getUser();

        $kafkaMessage = new KafkaMessageDTO(
            type: self::MESSAGE_TYPE_SMS,
            userPhone: $user->getPhone(),
            userEmail: $user->getEmail(),
        );

        $this->producerService->produce($this->userRegistrationTopic, $kafkaMessage);
    }
}
