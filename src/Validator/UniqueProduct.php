<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class UniqueProduct extends Constraint
{
    public string $message = 'The product {{ value }} is already used.';

    public string $idProperty;

    public function __construct(
        string $idProperty = 'id',
        mixed $options = null,
        ?array $groups = null,
        mixed $payload = null
    ) {
        parent::__construct($options, $groups, $payload);
        $this->idProperty = $idProperty;
    }

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }

    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
