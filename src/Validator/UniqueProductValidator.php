<?php

namespace App\Validator;

use App\Service\ProductService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class UniqueProductValidator extends ConstraintValidator
{
    public function __construct(
        private readonly ProductService $service
    ) {}

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof UniqueProduct) {
            throw new UnexpectedTypeException($constraint, UniqueProduct::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        $criteria = ['name' => $value];

        if ($this->service->getByCriteria($criteria)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
