<?php

namespace App\Service\Product;

use App\DTO\ApiResponse;
use App\DTO\Product\Deleted\InputDTO;
use App\Procedure\ProductProcedures;

readonly class Deleted
{
    public function __construct(
        private ProductProcedures $procedure,
    ) {}

    public function delete(InputDto $dto): array
    {
        $this->procedure->delete($dto);

        return ApiResponse::withMessage(
            ['ids' => $dto->ids],
            'Products successfully deleted.'
        )->toArray();
    }
}
