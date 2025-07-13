<?php

namespace App\Message\Command\Product;

use App\DTO\Product\OutputItemDTO;

class CreateMessage implements MessageInterface
{
    private OutputItemDTO $product;

    public function __construct(OutputItemDTO $product)
    {
        $this->product = $product;
    }

    public function getProduct(): OutputItemDTO
    {
        return $this->product;
    }
}
