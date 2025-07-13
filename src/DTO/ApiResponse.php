<?php

namespace App\DTO;

class ApiResponse
{
    public mixed $data;

    public ?array $meta;

    public ?string $message;

    public function __construct(
        mixed $data,
        ?array $meta = [],
        ?string $message = null
    ) {
        $this->data = $data;
        $this->meta = $meta;
        $this->message = $message;
    }

    public static function withMessage(array $data, string $message, string $dataKey = 'user'): self
    {
        $data['message'] = $message;

        return new self(data: $data, meta: []);
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
