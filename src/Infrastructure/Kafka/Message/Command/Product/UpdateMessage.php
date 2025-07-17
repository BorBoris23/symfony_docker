<?php

namespace App\Infrastructure\Kafka\Message\Command\Product;

use App\DTO\Product\OutputItemDTO;
use App\Infrastructure\Kafka\Message\Command\MessageInterface;

class UpdateMessage implements MessageInterface
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
