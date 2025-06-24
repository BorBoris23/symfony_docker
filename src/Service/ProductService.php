<?php

namespace App\Service;

use App\DTO\PaginationParamsDTO;
use App\DTO\Product\Create\InputDTO as CreateInputDTO;
use App\DTO\Product\List\OutputListDTO;
use App\DTO\Product\OutputItemDTO;
use App\DTO\Product\Update\InputDTO as UpdateInputDTO;
use App\Entity\Product;
use App\Repository\ProductRepository;
use App\DTO\Product\Deleted\InputDTO as DeleteInputDto;

readonly class ProductService
{
    public function __construct(
        private ProductRepository $productRepository
    ) {}

    public function getByCriteria(array $criteria): ?Product
    {
        return $this->productRepository->findOneBy($criteria);
    }

    public function create(CreateInputDTO $inputDto): OutputItemDTO
    {
        $product = $this->productRepository->create($inputDto);

        return (new OutputItemDTO(
            $product->getId(),
            $product->getName(),
            $product->getWeight(),
            $product->getHeight(),
            $product->getWidth(),
            $product->getLength(),
            $product->getDescription(),
            $product->getCost(),
            $product->getTax(),
            $product->getVersion()
        ));
    }

    public function getList(PaginationParamsDTO $pagination): OutputListDTO
    {
        $this->productRepository->findPaginated($pagination);

        $responseList = new OutputListDTO();

        foreach ($this->productRepository->findPaginated($pagination) as $product) {
            $responseList->items[] = new OutputItemDTO(
                $product->getId(),
                $product->getName(),
                $product->getWeight(),
                $product->getHeight(),
                $product->getWidth(),
                $product->getLength(),
                $product->getDescription(),
                $product->getCost(),
                $product->getTax(),
                $product->getVersion()
            );
        }

        return $responseList;
    }

    public function getTotalCount(): int
    {
        return $this->productRepository->count();
    }

    public function update(UpdateInputDTO $dto): OutputItemDTO
    {
        $product = $this->productRepository->update($dto);

        return (new OutputItemDTO(
            $product->getId(),
            $product->getName(),
            $product->getWeight(),
            $product->getHeight(),
            $product->getWidth(),
            $product->getLength(),
            $product->getDescription(),
            $product->getCost(),
            $product->getTax(),
            $product->getVersion()
        ));
    }

    public function delete(DeleteInputDto $dto): void
    {
        $this->productRepository->delete($dto);
    }
}
