<?php

namespace Mjolnir\Abstracts;

use Mjolnir\Hooks\Group;
use Mjolnir\Hooks\Hook;
use Mjolnir\Hooks\HookRepository;
use Mjolnir\Traits\GetContainer;
use Mjolnir\Traits\Instantiable;

abstract class AbstractHook
{
    use Instantiable, GetContainer;

    protected static string $action = "add_action";

    /**
     * @param string $tag
     * @return Group
     */
    public static function group(string $tag)
    {
        return new Group(static::$action, $tag);
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

        static::container()->extend(HookRepository::class)
            ->addMethodCall('add', [$hook]);
    }
}
