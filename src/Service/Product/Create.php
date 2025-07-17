<?php

namespace App\Service\Product;

use App\DTO\ApiResponse;
use App\DTO\Product\Create\InputDTO;
use App\Infrastructure\Kafka\Message\Command\Product\CreateMessage;
use App\Procedure\ProductProcedures;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

readonly class Create
{
    public function __construct(
        private ProductProcedures $procedure,
        private SerializerINterface $serializer,
        private MessageBusInterface $messageBus,
    ) {}

    /**
     * @throws ExceptionInterface
     */
    public function create(InputDto $dto): array
    {
        $outputDto = $this->procedure->create($dto);

        $response = new ApiResponse($outputDto);

        $this->messageBus->dispatch(new CreateMessage($outputDto));

        return $this->serializer->normalize($response->toArray(), 'json');
    }
}
