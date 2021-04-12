<?php

namespace Mjolnir\Hooks;

use Mjolnir\Exceptions\HookResolverException;
use Mjolnir\Support\Is;
use function Mjolnir\container;

class HookResolver
{

    private $function;

    /**
     * HookResolver constructor.
     * @param $function
     */
    public function __construct($function)
    {
        $this->function = $function;
    }

    /**
     * @param $function
     * @return array|mixed|object
     * @throws HookResolverException
     */
    public static function resolve($function)
    {
        return (new static($function))
            ->return();
    }

    /**
     * @return array|mixed|object
     * @throws HookResolverException
     */
    private function return()
    {
        if (Is::arr($this->function)) {
            return $this->array();
        }

        if (Is::callable($this->function)) {
            return $this->callable();
        }

        if (Is::str($this->function)) {
            return $this->invoke();
        }

        throw new HookResolverException('Incorrect type of given function in hook');
    }

    /**
     * @return array
     * @throws HookResolverException
     */
    private function array()
    {
        if (Is::obj($this->function['0'])) {
            return $this->function;
        }

        if (!container()->has($this->function['0'])) {
            throw new HookResolverException('Class or method applied to hook not exists');
        }

        return [container()->get($this->function['0']), $this->function['1']];
    }

    /**
     * @return mixed
     */
    private function callable()
    {
        return $this->function;
    }

    /**
     * @return array|mixed|object
     * @throws HookResolverException
     */
    private function invoke()
    {
        if (!class_exists($this->function) ||
            !container()->has($this->function)) {
            throw new HookResolverException('Class or method applied to hook not exists');
        }

        return container()->get($this->function);
    }
}
