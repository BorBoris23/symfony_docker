<?php

declare(strict_types=1);

namespace App\DTO\Registration;

use App\DTO\KafkaMessageInterface;

readonly class KafkaMessageDTO implements KafkaMessageInterface
{
    public function __construct(
        private string $type,
        private ?string $userPhone,
        private ?string $userEmail,
        private ?string $promoId = null
    ) {}

    public function getType(): string
    {
        return $this->type;
    }

    public function getUserPhone(): ?string
    {
        return $this->userPhone;
    }

    public function getUserEmail(): ?string
    {
        return $this->userEmail;
    }

    public function getPromoId(): ?string
    {
        return $this->promoId;
    }
}
