<?php

namespace Esteveli\SpainValidator\Validator\Constraints;

use Skilla\ValidatorCifNifNie\Generator;
use Skilla\ValidatorCifNifNie\InvalidParameterException;
use Skilla\ValidatorCifNifNie\Validator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class DniCifValidator
 * @package Esteveli\SpainValidator\Validator\Constraints
 * @author Juanjo García <juanjogarcia@editartgroup.com>
 */
class DniCifValidator extends ConstraintValidator {

    private Validator $validator;

    function __construct()
    {
        $this->validator = new Validator(new Generator());
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if ($value === null || $value === '') {
            return;
        }

        if (! $constraint instanceof DniCif) {
            throw new UnexpectedTypeException($constraint, DniCif::class);
        }

        if (! \is_scalar($value) && ! (\is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = (string) $value;

        try {
            if($this->validator->validate($value)){
                return;
            }
        }catch (InvalidParameterException){

        }

        $this->context
            ->buildViolation($constraint->message)
            ->addViolation();
    }
}
