<?php

namespace App\Controller\Api\Product;

use App\DTO\ApiResponse;
use App\DTO\Product\Create\InputDTO;
use App\Message\Command\Product\CreateMessage;
use App\Service\ProductService;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

readonly class CreateManager
{
    public function __construct(
        private ProductService $productService,
        private SerializerINterface $serializer,
        private MessageBusInterface $messageBus,
    ) {}

    /**
     * @throws ExceptionInterface
     */
    public function create(InputDto $dto): array
    {
        $outputDto = $this->productService->create($dto);

        $response = new ApiResponse($outputDto);

        $this->messageBus->dispatch(new CreateMessage($outputDto));

        return $this->serializer->normalize($response->toArray(), 'json');
    }
}
