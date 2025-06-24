<?php

namespace App\DTO\Registration;

class OutputDto
{
    private int $id;

    private string $name;

    private string $email;

    private string $phone;

    public function __construct(
        int $id,
        string $name,
        string $email,
        string $phone
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

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
