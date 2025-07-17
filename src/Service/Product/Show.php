<?php

namespace App\Service\Product;

use App\DTO\ApiResponse;
use App\DTO\Product\Show\InputDto;
use App\Procedure\ProductProcedures;
use Symfony\Component\Serializer\SerializerInterface;

readonly class Show
{
    public function __construct(
        private ProductProcedures $procedure,
        private SerializerINterface $serializer,
    ) {}

    public function show(InputDto $dto): array
    {
        $response = new ApiResponse($this->procedure->getById($dto));

        return $this->serializer->normalize($response->toArray(), 'json');
    }
}
