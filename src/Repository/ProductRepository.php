<?php

namespace App\Repository;

use App\DTO\PaginationParamsDTO;
use App\DTO\Product\Create\InputDTO as CreateInputDTO;
use App\DTO\Product\Update\InputDTO as UpdateInputDTO;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\DTO\Product\Deleted\InputDTO as DeleteInputDto;

class ProductRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
        $this->em = $this->getEntityManager();
    }

    public function create(CreateInputDTO $inputDto): Product
    {
        $product = (new Product())
            ->setName($inputDto->name)
            ->setWeight($inputDto->weight)
            ->setHeight($inputDto->height)
            ->setLength($inputDto->length)
            ->setWidth($inputDto->width)
            ->setDescription($inputDto->description)
            ->setVersion($inputDto->version)
            ->setCost($inputDto->cost)
            ->setTax($inputDto->tax);

        $this->em->persist($product);
        $this->em->flush();

        return $product;
    }

    public function update(UpdateInputDTO $inputDto): Product
    {
        $product = $this->find($inputDto->id);
        $product->setName($inputDto->name)
            ->setWeight($inputDto->weight)
            ->setHeight($inputDto->height)
            ->setLength($inputDto->length)
            ->setWidth($inputDto->width)
            ->setDescription($inputDto->description)
            ->setVersion($inputDto->version)
            ->setCost($inputDto->cost)
            ->setTax($inputDto->tax);

        $this->em->persist($product);
        $this->em->flush();

        return $product;
    }

    public function delete(DeleteInputDto $inputDto): void
    {
        $criteria = [
            'id' => $inputDto->ids
        ];

        $products = $this->findBy($criteria);

        foreach ($products as $product) {
            $this->em->remove($product);
        }

        $this->em->flush();
    }

    /**
     * Возвращает продукты с учетом пагинации.
     *
     * @return Product[]
     */
    public function findPaginated(PaginationParamsDTO $pagination): array
    {
        return $this->findBy([], null, $pagination->limit, $pagination->getOffset());
    }
}
