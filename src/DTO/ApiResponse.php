<?php

namespace App\DTO;

class ApiResponse
{
    public mixed $data;
    public ?array $meta;

    public function __construct(mixed $data, ?array $meta = [])
    {
        $this->data = $data;
        $this->meta = $meta;
    }

    public static function withPagination(
        array $items,
        int $total,
        int $page,
        int $limit
    ): self {
        $pages = (int) ceil($total / $limit);

        return new self(
            data: $items,
            meta: [
                'total' => $total,
                'page' => $page,
                'limit' => $limit,
                'pages' => $pages,
            ]
        );
    }

    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'meta' => $this->meta,
        ];
    }
}
