<?php

namespace App\Service;

use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ModelFactory
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @throws ValidationFailedException
     */
    public function makeModel(string $modelClass, ...$parameters): object
    {
        $model = new $modelClass(...$parameters);
        $violations = $this->validator->validate($model);
        if ($violations->count() > 0) {
            throw new ValidationFailedException($parameters, $violations);
        }

        return $model;
    }
}
