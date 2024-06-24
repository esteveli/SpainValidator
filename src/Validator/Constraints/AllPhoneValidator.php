<?php

namespace Esteveli\SpainValidator\Validator\Constraints;

use http\Message\Body;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;


class AllPhoneValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if ($value === null || $value === '') {
            return;
        }

        if (! $constraint instanceof AllPhone) {
            throw new UnexpectedTypeException($constraint, AllPhone::class);
        }

        if (! \is_scalar($value) && ! (\is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = (string) $value;

        if(preg_match('/[6-9]\d{8}/', $value)){
            return;
        }

        $this->context
            ->buildViolation($constraint->message)
            ->addViolation();
    }
}