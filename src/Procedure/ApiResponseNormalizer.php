<?php

namespace App\Procedure;

use App\DTO\ApiResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ApiResponseNormalizer implements NormalizerInterface
{
    public function normalize(
        mixed $data,
        ?string $format = null,
        array $context = []
    ): array|string|int|float|bool|\ArrayObject|null {
        return $data->toArray();
    }

    public function supportsNormalization(
        mixed $data,
        ?string $format = null,
        array $context = []
    ): bool {
        return $data instanceof ApiResponse;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            ApiResponse::class => true,
        ];
    }
}
