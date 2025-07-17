<?php

namespace App\Validator;

use App\Repository\ProductRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class UniqueProductValidator extends ConstraintValidator
{
    public function __construct(private readonly ProductRepository $repository) {}

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

        $object = $this->context->getObject();

        $id = null;
        if (property_exists($object, $constraint->idProperty)) {
            $id = $object->{$constraint->idProperty};
        }

        $existing = $this->repository->findOneBy(['article' => $value]);

        if ($existing && $existing->getId() !== $id) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
