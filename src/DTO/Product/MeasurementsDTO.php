<?php

namespace App\DTO\Product;

readonly class MeasurementsDTO
{
    public function __construct(
        private int $weight,
        private int $height,
        private int $width,
        private int $length,
    ) {}

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getLength(): int
    {
        return $this->length;
    }
}
