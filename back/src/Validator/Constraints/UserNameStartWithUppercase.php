<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Custom validation constraint for the User name
 *
 * @Annotation
 */
class UserNameStartWithUppercase extends Constraint
{
    // Message that will be displayed if the value is not valid
    public $message = "The user name must start with uppercase character";
}
