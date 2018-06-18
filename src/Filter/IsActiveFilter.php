<?php

namespace App\Filter;

use Doctrine\Common\Annotations\Reader;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class IsActiveFilter extends SQLFilter
{
    protected $reader;

    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        if (empty($this->reader)) {
            return '';
        }

        $isActive = $this->reader->getClassAnnotation($targetEntity->getReflectionClass(),'App\\Annotation\\IsActive');

        if (!$isActive) {
            return '';
        }

        $fieldName = $isActive->fieldName;

        if (empty($fieldName)) {
            return '';
        }

        $query = sprintf('%s.%s = %s', $targetTableAlias, $fieldName, 1);

        return $query;
    }

    public function setAnnotationReader(Reader $reader) {
        $this->reader = $reader;
    }
}