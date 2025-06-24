<?php

namespace App\DTO\Product\List;

use App\DTO\Product\OutputItemDTO;

class OutputListDTO
{
    /** @var OutputItemDTO[] */
    public array $items = [];

    public function toArray(): array
    {
        return array_map(static fn(OutputItemDTO $item) => (array) $item, $this->items);
    }
}
