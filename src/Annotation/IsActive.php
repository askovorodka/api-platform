<?php
namespace App\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class IsActive
 * @package App\Annotation
 * @Annotation
 * @Target("CLASS")
 */
final class IsActive
{
    public $fieldName;
}