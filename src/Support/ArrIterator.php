<?php

namespace Mjolnir\Support;

use Iterator;

class ArrIterator implements Iterator
{
    private array $elements = [];

    /**
     * @param array $elements
     */
    public function __construct(array $elements)
    {
        $this->elements = $elements;
    }

    /**
     * @return mixed
     */
    public function rewind()
    {
        reset($this->elements);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        $var = current($this->elements);
        return $var;
    }

    /**
     * @return bool|float|int|string|null
     */
    public function key()
    {
        $var = key($this->elements);
        return $var;
    }

    /**
     * @return mixed|void
     */
    public function next()
    {
        $var = next($this->elements);
        return $var;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        $key = key($this->elements);
        return ($key !== NULL && $key !== FALSE);
    }

}
