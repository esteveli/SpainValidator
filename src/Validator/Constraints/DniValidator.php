<?php

namespace Esteveli\SpainValidator\Validator\Constraints;

use Skilla\ValidatorCifNifNie\Generator;
use Skilla\ValidatorCifNifNie\Validator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;


/**
 * Class DniValidator
 * @package Esteveli\SpainValidator\Validator\Constraints
 * @author Álvaro de la Vega Olmedilla <alvarodlvo@gmail.com>
 */
class DniValidator extends ConstraintValidator
{
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

        if (! $constraint instanceof Dni) {
            throw new UnexpectedTypeException($constraint, Dni::class);
        }

        if (! \is_scalar($value) && ! (\is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = (string) $value;

        if($this->validator->isValidNIF($value))
        {
            return;
        }
        $this->context
            ->buildViolation($constraint->message)
            ->addViolation();
    }

}