<?php

namespace Esteveli\SpainValidator\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;


class ZipCodeValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if ($value === null || $value === '') {
            return;
        }

        if (! $constraint instanceof ZipCode) {
            throw new UnexpectedTypeException($constraint, ZipCode::class);
        }

        if (! \is_scalar($value) && ! (\is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = (string) $value;

        if (preg_match('/(?:0[1-9]|[1-4]\d|5[0-2])\d{3}/', $value))
        {
            return;
        }
        $this->context
            ->buildViolation($constraint->message)
            ->addViolation();
    }
}
