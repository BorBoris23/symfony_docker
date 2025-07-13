<?php

namespace App\DTO\Product;

class OutputItemDTO
{
    private int $id;
    private string $name;
    private int $weight;
    private int $height;
    private int $width;
    private int $length;
    private string $description;
    private int $cost;
    private int $tax;
    private int $version;

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

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function getTax(): int
    {
        return $this->tax;
    }

    public function getVersion(): int
    {
        return $this->version;
    }
}
