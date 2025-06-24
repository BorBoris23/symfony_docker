<?php

namespace App\Controller\Api\Product;

use App\DTO\ApiResponse;
use App\DTO\Product\Update\InputDTO;
use App\Service\ProductService;
use Symfony\Component\Serializer\SerializerInterface;

class UpdateManager
{
    private SerializerINterface $serializer;

    private ProductService $productService;

    public function __construct(
        ProductService $productService,
        SerializerInterface $serializer
    ) {
        $this->productService = $productService;
        $this->serializer = $serializer;
    }

    public function update(InputDto $dto): array
    {
        $response = new ApiResponse(
            $this->productService->update($dto)
        );

        return $this->serializer->normalize($response, 'json');
    }
}
