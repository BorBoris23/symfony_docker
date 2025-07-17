<?php

namespace App\Service\Product;

use App\DTO\ApiResponse;
use App\DTO\Product\Update\InputDTO;
use App\Infrastructure\Kafka\Message\Command\Product\UpdateMessage;
use App\Procedure\ProductProcedures;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

readonly class Update
{
    public function __construct(
        private ProductProcedures $procedure,
        private SerializerINterface $serializer,
        private MessageBusInterface $messageBus,
    ) {}

    /**
     * @throws ExceptionInterface
     */
    public function update(InputDto $dto): array
    {
        $outputDto = $this->procedure->update($dto);

        $response = new ApiResponse($outputDto);

        $this->messageBus->dispatch(new UpdateMessage($outputDto));

        return $this->serializer->normalize($response->toArray(), 'json');
    }
}
