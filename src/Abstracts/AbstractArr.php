<?php

namespace Mjolnir\Abstracts;

use IteratorAggregate;
use Mjolnir\Contracts\ArrInterface;
use Mjolnir\Support\ArrIterator;

abstract class AbstractArr implements ArrInterface, IteratorAggregate
{
    /**
     * @var array
     */
    protected array $elements = [];

    /**
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    /**
     * @param array $elements
     * @return static
     */
    public static function make(array $elements = [])
    {
        return new static($elements);
    }

    /**
     * @param mixed $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->offsetGet($key);
    }

    /**
     * @param $key
     * @param $value
     * @return self
     */
    public function set($key, $value)
    {
        $this->offsetSet($key, $value);

        return $this;
    }

    /**
     * @param $element
     * @return false|int|string
     */
    public function search($element)
    {
        return array_search($element, $this->elements, true);
    }

    /**
     * @param $element
     * @return static
     */
    public function remove($element)
    {
        if ($this->hasKey($element)) {
            $this->offsetUnset($element);
        } else {
            $this->offsetUnset($this->search($element));
        }

        return $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key)
    {
        return array_key_exists($key, $this->elements);
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasKey($key)
    {
        return array_key_exists($key, $this->elements);
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->elements);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->elements);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            return false;
        }

        return $this->elements[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->elements[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->elements[$offset]);
    }

    /**
     * @return ArrIterator
     */
    public function getIterator()
    {
        return new ArrIterator($this->elements);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->elements;
    }
}
