<?php

namespace Mjolnir\Hooks;

use Mjolnir\Contracts\HookInterface;
use Mjolnir\Exceptions\HookResolverException;

class Action implements HookInterface
{
    /**
     * @param string $tag
     * @param $functionToAdd
     * @param int $priority
     * @param int $acceptedArgs
     * @return Action
     * @throws HookResolverException
     */
    public static function add(string $tag, $functionToAdd, int $priority = 10, int $acceptedArgs = 1)
    {
        return (new static)->call($tag, $functionToAdd, $priority, $acceptedArgs);
    }

    /**
     * @param string $tag
     * @return Group
     */
    public static function group(string $tag)
    {
        return new Group('action', $tag);
    }

    /**
     * @param string $tag
     * @param $functionToAdd
     * @param int $priority
     * @param int $acceptedArgs
     * @return $this
     * @throws HookResolverException
     */
    public function call(string $tag, $functionToAdd, int $priority = 10, int $acceptedArgs = 1)
    {
        $resolvedFunction = HookResolver::resolve($functionToAdd);

        add_action($tag, $resolvedFunction, $priority, $acceptedArgs);

        return $this;
    }

    /**
     * @param $tag
     * @param mixed ...$arg
     */
    public static function do($tag, ...$arg)
    {
        do_action($tag, $arg);
    }
}
