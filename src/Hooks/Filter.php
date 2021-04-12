<?php

namespace Mjolnir\Hooks;

use Mjolnir\Contracts\HookInterface;
use Mjolnir\Exceptions\HookResolverException;

class Filter implements HookInterface
{
    /**
     * @param string $tag
     * @param $functionToAdd
     * @param int $priority
     * @param int $acceptedArgs
     * @return Filter
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
        return new Group('filter', $tag);
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

        add_filter($tag, $resolvedFunction, $priority, $acceptedArgs);

        return $this;
    }

    /**
     * @param $tag
     * @param $value
     */
    public static function apply($tag, $value)
    {
        apply_filters($tag, $value);
    }
}
