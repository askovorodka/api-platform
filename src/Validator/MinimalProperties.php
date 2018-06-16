<?php
namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Class MinimalProperties
 * @package App\Validator
 * @Annotation
 */
class MinimalProperties extends Constraint
{

    public $message = 'This product must have the minimal properties required (price and description)';
}