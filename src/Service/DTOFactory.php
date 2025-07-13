<?php

namespace App\Service;

use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class DTOFactory
{
    public function __construct(
        private ValidatorInterface $validator
    ) {}

    /**
     * Создает и валидирует DTO.
     *
     * @template T
     * @param class-string<T> $dtoClass
     * @param mixed ...$parameters
     * @return T
     * @throws ValidationFailedException
     */
    public function make(string $dtoClass, ...$parameters): object
    {
        $dto = new $dtoClass(...$parameters);

        $violations = $this->validator->validate($dto);

        if ($violations->count() > 0) {
            throw new ValidationFailedException($parameters, $violations);
        }

        return $dto;
    }
}
