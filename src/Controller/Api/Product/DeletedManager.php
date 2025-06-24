<?php

namespace App\Controller\Api\Product;

use App\DTO\Product\Deleted\InputDTO;
use App\Service\ProductService;

class DeletedManager
{
    private ProductService $productService;

    public function __construct(
        ProductService $productService,
    ) {
        $this->productService = $productService;
    }

    public function delete(InputDto $dto): array
    {
        $this->productService->delete($dto);

        return [
            'status' => 'success',
            'message' => 'Products successfully deleted.',
            'ids' => $dto->ids,
        ];
    }
}
