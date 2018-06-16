<?php
namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class MinimalPropertiesValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!empty(array_diff(['description', 'price'], $value))) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}