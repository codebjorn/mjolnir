<?php

namespace Mjolnir\Traits;

use ReflectionClass;
use ReflectionProperty;

trait Factoryable
{
    /**
     * @param array|null $parameters
     */
    public function __construct(array $parameters = null)
    {
        $class = new ReflectionClass(static::class);

        foreach ($class->getProperties(ReflectionProperty::IS_PRIVATE) as $reflectionProperty) {
            $property = $reflectionProperty->getName();
            if (isset($parameters[$property])) {
                $this->{$property} = $parameters[$property];
            }
        }
    }
}
