<?php

namespace App\DTO;

readonly class PaginationParamsDTO
{
    public function __construct(
        public int $page = 1,
        public int $limit = 10,
    ) {}

    public function getOffset(): int
    {
        return ($this->page - 1) * $this->limit;
    }
}
