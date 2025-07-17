<?php

namespace App\DTO\Product;

use App\DTO\KafkaMessageInterface;

readonly class KafkaMessageDTO implements KafkaMessageInterface
{
    public function __construct(
        private int $id,
        private string $name,
        private string $article,
        private MeasurementsDTO $measurements,
        private ?string $description,
        private int $cost,
        private int $tax,
        private int $version,
        private int $quantity,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getArticle(): string
    {
        return $this->article;
    }

    public function getMeasurements(): MeasurementsDTO
    {
        return $this->measurements;
    }

    public function getDescription(): ?string
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

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
