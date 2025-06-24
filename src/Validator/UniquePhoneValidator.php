<?php

namespace App\Validator;

use App\Service\UserService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class UniquePhoneValidator extends ConstraintValidator
{
    public function __construct(
        private readonly UserService $service
    ) {}

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof UniquePhone) {
            throw new UnexpectedTypeException($constraint, UniquePhone::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        $criteria = ['phone' => $value];

        if ($this->service->getByCriteria($criteria)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
