<?php

namespace App\DTO\Registration;

readonly class OutputDto
{
    public function __construct(
        private int $id,
        private string $name,
        private string $email,
        private string $phone,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}
