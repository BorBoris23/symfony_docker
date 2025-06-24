<?php

namespace App\Controller\Api\Product;

use App\DTO\ApiResponse;
use App\DTO\Product\Create\InputDTO;
use App\Service\ProductService;
use Symfony\Component\Serializer\SerializerInterface;

class CreateManager
{
    private SerializerINterface $serializer;
    private ProductService $productService;

    public function __construct(
        ProductService $productService,
        SerializerINterface $serializer
    ) {
        $this->productService = $productService;
        $this->serializer = $serializer;
    }

    public function create(InputDto $dto): array
    {
        $response = new ApiResponse(
            $this->productService->create($dto)
        );

        return $this->serializer->normalize($response, 'json');
    }
}
