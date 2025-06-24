<?php

namespace App\DTO\Product\List;

use Symfony\Component\Validator\Constraints as Assert;

class InputDTO
{
    #[Assert\NotBlank(message: "Page is required.")]
    #[Assert\Type(type: 'digit', message: "Page must be a number.")]
    #[Assert\Positive(message: "Page must be greater than 0.")]
    public string $page = '1';

    #[Assert\NotBlank(message: "Limit is required.")]
    #[Assert\Type(type: 'digit', message: "Limit must be a number.")]
    #[Assert\Positive(message: "Limit must be greater than 0.")]
    public string $limit = '10';

    public function getPage(): int
    {
        return (int) $this->page;
    }

    public function getLimit(): int
    {
        return (int) $this->limit;
    }

    public function getOffset(): int
    {
        return ($this->getPage() - 1) * $this->getLimit();
    }
}
