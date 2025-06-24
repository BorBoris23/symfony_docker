<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class UniquePhone extends Constraint
{
    public string $message = 'Phone number {{ value }} is already used.';

    public function validatedBy(): string
    {
        return static::class.'Validator';
    }

    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
