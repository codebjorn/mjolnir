<?php

namespace Mjolnir\Abstracts;

use Mjolnir\Traits\AppSingleton;
use RuntimeException;

abstract class AbstractFacade
{

    /**
     * @var object
     */
    protected static $resolvedInstance;
    /**
     * @var AbstractApp|AppSingleton
     */
    protected static $app;
    /**
     * @var string
     */
    protected static $accessor;

    /**
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
     * @param string $method
     * @param array $args
     * @return mixed
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
