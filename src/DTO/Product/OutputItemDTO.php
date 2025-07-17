<?php

namespace App\DTO\Product;

readonly class OutputItemDTO
{
    public function __construct(
        private int $id,
        private string $name,
        private string $article,
        private int $weight,
        private int $height,
        private int $width,
        private int $length,
        private string $description,
        private int $cost,
        private int $tax,
        private int $version,
        private int $quantity,
    ) {}

    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getArticle(): string { return $this->article; }
    public function getWeight(): int { return $this->weight; }
    public function getHeight(): int { return $this->height; }
    public function getWidth(): int { return $this->width; }
    public function getLength(): int { return $this->length; }
    public function getDescription(): string { return $this->description; }
    public function getCost(): int { return $this->cost; }
    public function getTax(): int { return $this->tax; }
    public function getVersion(): int { return $this->version; }
    public function getQuantity(): int { return $this->quantity; }
}
