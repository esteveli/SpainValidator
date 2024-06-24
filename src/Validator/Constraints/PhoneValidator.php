<?php

namespace Esteveli\SpainValidator\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;


/**
 * Class PhoneValidator
 * @package Esteveli\SpainValidator\Validator\Constraints
 * @author Álvaro de la Vega Olmedilla <alvarodlvo@gmail.com>
 */
class PhoneValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if ($value === null || $value === '') {
            return;
        }

        if (! $constraint instanceof Phone) {
            throw new UnexpectedTypeException($constraint, Phone::class);
        }

        if (! \is_scalar($value) && ! (\is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = (string) $value;

        if (preg_match('/[8-9]\d{8}/', $value))
        {
            return;
        }
        $this->context
            ->buildViolation($constraint->message)
            ->addViolation();
    }
}