<?php
namespace Mjolnir\Abstracts;

use ReflectionClass;
use ReflectionException;
use Mjolnir\Support\Collection;
use Mjolnir\Support\Is;

abstract class AbstractQuery
{
    /**
     * @var array|null
     */
    protected ?array $arguments;

    /**
     * @param array $arguments
     */
    public function __construct(array $arguments = [])
    {
        $this->arguments = $arguments;
    }

    /**
     * @return mixed
     */
    abstract public function make();

    /**
     * @return mixed
     */
    abstract public function get();

    /**
     * @return mixed
     */
    abstract public function getRaw();

    /**
     * @param $concrete
     * @param $object
     * @param mixed ...$arguments
     * @return array|null
     * @throws ReflectionException
     */
    protected function updateArgs($concrete, $object, ...$arguments)
    {
        if (Is::obj($object)) {
            $newArgs = $object->toArray();
        } else {
            $args = (new Collection($arguments))->unshift($object);
            $reflection = new ReflectionClass($concrete);
            $obj = $reflection->newInstanceArgs($args->toArray());
            $newArgs = $obj->toArray();
        }

        $this->arguments = array_merge_recursive($this->arguments, $newArgs);

        return $this->arguments;
    }
}
