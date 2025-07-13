<?php

namespace App\Controller\Api\Product;

use App\DTO\ApiResponse;
use App\DTO\Product\Update\InputDTO;
use App\Message\Command\Product\UpdateMessage;
use App\Service\ProductService;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

readonly class UpdateManager
{
    public function __construct(
        private ProductService $productService,
        private SerializerInterface $serializer,
        private MessageBusInterface $messageBus,
    ) {}

    /**
     * @throws ExceptionInterface
     */
    public function update(InputDto $dto): array
    {
        $outputDto = $this->productService->update($dto);

        $response = new ApiResponse($outputDto);

        $this->messageBus->dispatch(new UpdateMessage($outputDto));

        return $this->serializer->normalize($response->toArray(), 'json');
    }
}
