<?php

namespace Mjolnir\Abstracts;

use Mjolnir\Hooks\Group;
use Mjolnir\Hooks\Hook;

abstract class AbstractHook
{
    protected static $action = "add_action";
    protected static $containerClass;

    /**
     * @param string $tag
     * @return Group
     */
    public static function group(string $tag): Group
    {
        return new Group(static::$containerClass, static::$action, $tag);
    }

    /**
     * @param string $tag
     * @param $function
     * @param int $priority
     * @param int $args
     */
    public static function add(string $tag, $function, int $priority = 10, int $args = 1)
    {
        $hook = new Hook(static::$action, $tag, [
            'function' => $function,
            'priority' => $priority,
            'args' => $args
        ]);

        if (static::$containerClass) {
            $container = call_user_func([static::$containerClass, 'getInstance']);
            $container->extend('hooks')
                ->addMethodCall('add', [$hook]);
        }
    }
}
