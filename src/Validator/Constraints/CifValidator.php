<?php

namespace Esteveli\SpainValidator\Validator\Constraints;

use Skilla\ValidatorCifNifNie\Generator;
use Skilla\ValidatorCifNifNie\InvalidParameterException;
use Skilla\ValidatorCifNifNie\Validator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;


class CifValidator extends ConstraintValidator {

    private Validator $validator;

    function __construct()
    {
        $this->validator = new Validator(new Generator());
    }

    public function validate($value, Constraint $constraint) {
        if ($value === null || $value === '') {
            return;
        }

        if (! $constraint instanceof Cif) {
            throw new UnexpectedTypeException($constraint, Cif::class);
        }

        if (! \is_scalar($value) && ! (\is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = (string) $value;
        try {
            if($this->validator->isValidCIF($value)){
                return;
            }
        }catch (InvalidParameterException){

        }

        $this->context
            ->buildViolation($constraint->message)
            ->addViolation();
    }
}
