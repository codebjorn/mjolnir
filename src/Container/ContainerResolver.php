<?php

namespace Mjolnir\Container;

use Mjolnir\Abstracts\AbstractApp;
use Mjolnir\Exceptions\ContainerResolverException;
use Mjolnir\Support\Is;

class ContainerResolver
{
    /**
     * @var AbstractApp
     */
    protected $container;
    /**
     * @var mixed|string
     */
    private $function;

    /**
     * ContainerResolver constructor.
     * @param $container
     * @param $function
     */
    public function __construct($container, $function = null)
    {
        $this->container = $container;
        $this->function = $function ?? "";
    }

    /**
     * @param mixed $function
     * @return callable
     * @throws ContainerResolverException
     */
    public function resolve($function): callable
    {
        return (new static($this->container, $function))
            ->return();
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

        if (!$this->container->has($this->function['0'])) {
            throw new ContainerResolverException('Class or method applied to hook not exists');
        }

        return [$this->container->get($this->function['0']), $this->function['1']];
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
            !$this->container->has($this->function)) {
            throw new ContainerResolverException('Class or method applied to hook not exists');
        }

        return $this->container->get($this->function);
    }
}
