<?php

namespace App\DTO\Product\Update;

use App\Validator\ExistingProductId;
use App\Validator\UniqueProduct;
use Symfony\Component\Validator\Constraints as Assert;

class InputDTO
{
    #[Assert\NotNull]
    #[Assert\Type('integer')]
    #[Assert\Positive]
    #[ExistingProductId]
    public int $id;

    #[Assert\NotNull]
    #[Assert\Type('string')]
    #[Assert\Length(max: 255)]
    #[UniqueProduct(idProperty: 'id')]
    public string $article;

    #[Assert\NotNull]
    #[Assert\Type('string')]
    #[Assert\Length(max: 255)]
    public string $name;

    #[Assert\NotNull]
    #[Assert\Type('integer')]
    #[Assert\Positive]
    public int $weight;

    #[Assert\NotNull]
    #[Assert\Type('integer')]
    #[Assert\Positive]
    public int $height;

    #[Assert\NotNull]
    #[Assert\Type('integer')]
    #[Assert\Positive]
    public int $width;

    #[Assert\NotNull]
    #[Assert\Type('integer')]
    #[Assert\Positive]
    public int $length;

    #[Assert\Type('string')]
    #[Assert\Length(max: 1000)]
    public ?string $description = null;

    #[Assert\NotNull]
    #[Assert\Type('integer')]
    #[Assert\PositiveOrZero]
    public int $cost;

    #[Assert\NotNull]
    #[Assert\Type('integer')]
    #[Assert\PositiveOrZero]
    public int $tax;

    #[Assert\NotNull]
    #[Assert\Type('integer')]
    #[Assert\Positive]
    public int $version;

    #[Assert\NotNull]
    #[Assert\Type('integer')]
    #[Assert\PositiveOrZero]
    public int $quantity;
}
