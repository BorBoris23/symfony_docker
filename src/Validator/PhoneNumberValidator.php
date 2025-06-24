<?php

namespace App\Validator;

use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PhoneNumberValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof PhoneNumber) {
            throw new \InvalidArgumentException('Invalid constraint type');
        }

        if (!is_string($value) || empty($value)) {
            return;
        }

        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $phoneNumber = $phoneUtil->parse($value, $constraint->region);

            if (!$phoneUtil->isValidNumber($phoneNumber)) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ string }}', $value)
                    ->addViolation();
            }
        } catch (NumberParseException $e) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
