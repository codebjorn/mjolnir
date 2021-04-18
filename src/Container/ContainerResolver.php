<?php

namespace Mjolnir\Container;

use Mjolnir\Exceptions\ContainerResolverException;
use Mjolnir\Support\Is;
use Mjolnir\Traits\GetContainer;
use Psr\Container\ContainerInterface;

class ContainerResolver
{
    use GetContainer;

    private $function;

    /**
     * ContainerResolver constructor.
     * @param $function
     */
    public function __construct($function)
    {
        $this->function = $function;
    }

    /**
     * @param $function
     * @return array|mixed|object
     * @throws ContainerResolverException
     */
    public static function resolve($function)
    {
        return (new static($function))->return();
    }

    /**
     * @return array|mixed|object
     * @throws ContainerResolverException
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

        throw new ContainerResolverException('Incorrect type of given function in hook');
    }

    /**
     * @return array
     * @throws ContainerResolverException
     */
    private function array()
    {
        if (Is::obj($this->function['0'])) {
            return $this->function;
        }

        if (!static::container()->has($this->function['0'])) {
            throw new ContainerResolverException('Class or method applied to hook not exists');
        }

        return [static::container()->get($this->function['0']), $this->function['1']];
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
     * @throws ContainerResolverException
     */
    private function invoke()
    {
        if (!class_exists($this->function) ||
            !static::container()->has($this->function)) {
            throw new ContainerResolverException('Class or method applied to hook not exists');
        }

        return static::container()->get($this->function);
    }
}
