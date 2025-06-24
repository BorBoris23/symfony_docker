<?php

namespace App\DTO\Product;

class OutputItemDTO
{
    public int $id;
    public string $name;
    public int $weight;
    public int $height;
    public int $width;
    public int $length;
    public string $description;
    public int $cost;
    public int $tax;
    public int $version;

    public function __construct(
        int $id,
        string $name,
        int $weight,
        int $height,
        int $width,
        int $length,
        string $description,
        int $cost,
        int $tax,
        int $version
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->weight = $weight;
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
        $this->description = $description;
        $this->cost = $cost;
        $this->tax = $tax;
        $this->version = $version;
    }
}
