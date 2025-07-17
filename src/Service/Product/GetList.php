<?php

namespace App\Service\Product;

use App\DTO\ApiResponse;
use App\DTO\PaginationParamsDTO;
use App\DTO\Product\List\InputDTO;
use App\Procedure\ProductProcedures;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

readonly class GetList
{
    public function __construct(
        private ProductProcedures $procedure,
        private SerializerINterface $serializer,
    ) {}

    /**
     * @throws ExceptionInterface
     */
    public function getList(InputDTO $dto): array
    {
        $pagination = new PaginationParamsDTO($dto->getPage(), $dto->getLimit());

        $products = $this->procedure->getList($pagination);
        $total = $this->procedure->getTotalCount();

        $response = ApiResponse::withPagination(
            $products->items,
            $total,
            $pagination->page,
            $pagination->limit
        );

        return $this->serializer->normalize($response->toArray(), 'json');
    }
}
