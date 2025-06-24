<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class UniqueProduct extends Constraint
{
    public string $message = 'The product {{ value }} is already used.';

    public function validatedBy(): string
    {
        return static::class.'Validator';
    }

    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
