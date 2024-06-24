<?php

namespace Esteveli\SpainValidator\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ZipCode extends Constraint
{
    public string $message = 'validator.zip_code.not_valid';
}
