<?php

namespace App\Infrastructure\Kafka\Message\Command;

use App\DTO\Product\OutputItemDTO;

interface MessageInterface
{
    public function getProduct(): OutputItemDTO;
}
