<?php

namespace App\Controller\Api\Product;

use App\DTO\ApiResponse;
use App\Entity\Product;
use Symfony\Component\Serializer\SerializerInterface;

class ShowManager
{
    private SerializerINterface $serializer;

    public function __construct(
        SerializerInterface $serializer
    ) {
        $this->serializer = $serializer;
    }

    public function show(Product $product): array
    {
        $productData = $this->serializer->normalize($product, null, ['groups' => ['product:read']]);

        return (new ApiResponse($productData))->toArray();
    }
}
