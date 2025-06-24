<?php

namespace App\Controller\Api\Product;

use App\DTO\ApiResponse;
use App\DTO\PaginationParamsDTO;
use App\DTO\Product\List\InputDTO;
use App\Service\ProductService;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GetListManager
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

    /**
     * @throws ExceptionInterface
     */
    public function getList(InputDTO $dto): array
    {
        $pagination = new PaginationParamsDTO($dto->getPage(), $dto->getLimit());

        $products = $this->productService->getList($pagination);
        $total = $this->productService->getTotalCount();

        $response = ApiResponse::withPagination(
            $products->items,
            $total,
            $pagination->page,
            $pagination->limit
        );

        return $this->serializer->normalize($response, 'json');
    }
}
