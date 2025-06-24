<?php

namespace App\Validator;

use App\Repository\ProductRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class ExistingProductIdValidator extends ConstraintValidator
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param int $value
     * @param ExistingProductId $constraint
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof ExistingProductId) {
            throw new UnexpectedTypeException($constraint, ExistingProductId::class);
        }

        if (null === $value) {
            return;
        }

        if (!is_int($value)) {
            throw new UnexpectedValueException($value, 'int');
        }

        if (!$this->productRepository->find($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', (string)$value)
                ->addViolation();
        }
    }
}
