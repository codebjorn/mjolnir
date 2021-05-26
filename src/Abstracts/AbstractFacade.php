<?php

namespace Mjolnir\Abstracts;

use RuntimeException;

abstract class AbstractFacade
{

    protected static $resolvedInstance;
    protected static $app;
    protected static $accessor;

    /**
     * Resolve the facade root instance from the container.
     *
     * @param string|object|mixed $name
     * @return mixed
     */
    protected static function resolveInstance($name)
    {
        if (is_object($name)) {
            return $name;
        }

        if (isset(static::$resolvedInstance[$name])) {
            return static::$resolvedInstance[$name];
        }

        if (static::$app) {
            return static::$resolvedInstance[$name] = static::$app::getInstance()->get($name);
        }

        return null;
    }


    /**
     * Handle dynamic, static calls to the object.
     *
     * @param string $method
     * @param array $args
     * @return mixed
     *
     * @throws RuntimeException
     */
    public static function __callStatic(string $method, array $args)
    {
        $instance = static::resolveInstance(static::$accessor);

        if (!$instance) {
            throw new RuntimeException('A facade root has not been set.');
        }

        return $instance->$method(...$args);
    }

}
