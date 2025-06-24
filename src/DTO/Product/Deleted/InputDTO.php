<?php

namespace App\DTO\Product\Deleted;

use App\Validator\ExistingProductId;
use Symfony\Component\Validator\Constraints as Assert;

class InputDTO
{
    #[Assert\NotBlank]
    #[Assert\Type('array')]
    #[Assert\All([
        new Assert\Type('integer'),
        new Assert\Positive,
        new ExistingProductId(),
    ])]
    public array $ids;
}
