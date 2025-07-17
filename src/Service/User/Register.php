<?php

namespace App\Service\User;

use App\DTO\ApiResponse;
use App\DTO\Registration\InputDto;
use App\Infrastructure\Kafka\Message\Command\User\RegisteredMessage;
use App\Procedure\UserProcedures;
use RdKafka\Exception;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

readonly class Register
{
    private CONST string REGISTER_MESSAGE = 'User successfully registered';

    public function __construct(
        private UserProcedures $procedure,
        private SerializerInterface $serializer,
        private MessageBusInterface $messageBus,
    ) {}

    /**
     * @throws Exception
     * @throws ExceptionInterface
     */
    public function register(InputDto $dto): array
    {
//        $outputDto = $this->procedure->create($dto);

        $outputDto = $this->procedure->getUserByID(1);

        $response = ApiResponse::withMessage(
            data: $this->serializer->normalize($outputDto, 'array'),
            message: self::REGISTER_MESSAGE
        );

        $this->messageBus->dispatch(new RegisteredMessage($outputDto));

        return $this->serializer->normalize($response, 'json');
    }
}
