<?php

namespace App\Message\Command\Product;

use App\DTO\Product\OutputItemDTO;

interface MessageInterface
{
    public function getProduct(): OutputItemDTO;
}
