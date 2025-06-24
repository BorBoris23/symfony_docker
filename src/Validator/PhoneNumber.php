<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class PhoneNumber extends Constraint
{
    public string $message = 'The phone number "{{ string }}" is not valid.';

    public string $region;

    public function __construct(string $region = 'RU', ?array $groups = null, mixed $payload = null)
    {
        parent::__construct([], $groups, $payload);
        $this->region = $region;
    }
}
