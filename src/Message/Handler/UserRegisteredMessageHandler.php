<?php

namespace App\Message\Handler;

use App\DTO\Registration\KafkaMessageDTO;
use App\Message\Command\User\RegisteredMessage;
use App\Service\Kafka\ProducerService;
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
        $kafkaMessage = new KafkaMessageDTO(
            type: self::MESSAGE_TYPE_SMS,
            userPhone: $message->getUser()->getPhone(),
            userEmail: $message->getUser()->getEmail(),
        );

        $this->producerService->produce($this->userRegistrationTopic, $kafkaMessage);
    }
}
