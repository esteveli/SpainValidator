<?php

namespace Esteveli\SpainValidator\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;


/**
 * Class MobilePhoneValidator
 * @package Esteveli\SpainValidator\Validator\Constraints
 * @author Álvaro de la Vega Olmedilla <alvarodlvo@gmail.com>
 */
class MobilePhoneValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if ($value === null || $value === '') {
            return;
        }

        if (! $constraint instanceof MobilePhone) {
            throw new UnexpectedTypeException($constraint, MobilePhone::class);
        }

        if (! \is_scalar($value) && ! (\is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = (string) $value;

        if(preg_match('/[6-7]\d{8}/', $value)){
            return;
        }
        $this->context
            ->buildViolation($constraint->message)
            ->addViolation();
    }
}