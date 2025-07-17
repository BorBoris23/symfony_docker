<?php

namespace App\DTO\Product\Show;

use App\Validator\ExistingProductId;
use Symfony\Component\Validator\Constraints as Assert;

class InputDto
{
    #[Assert\NotNull]
    #[Assert\Type('int')]
    #[Assert\Positive]
    #[ExistingProductId]
    public int $id;
}
