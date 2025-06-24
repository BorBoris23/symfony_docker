<?php

namespace App\DTO\Product\Create;

use App\Validator\UniqueProduct;
use Symfony\Component\Validator\Constraints as Assert;

class InputDTO
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(max: 255)]
    #[UniqueProduct]
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
}
