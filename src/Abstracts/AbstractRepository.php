<?php

namespace Mjolnir\Abstracts;

use ArrayIterator;
use IteratorAggregate;
use Mjolnir\Support\Collection;

abstract class AbstractRepository implements IteratorAggregate
{
    /**
     * @var array|mixed
     */
    private $items;

    /**
     * AbstractRepository constructor.
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return new Collection($this->items);
    }

    /**
     * @param string $key
     * @return false|mixed
     */
    public function get(string $key)
    {
        return $this->items[$key];
    }

    /**
     * @param string $key
     * @return bool|false
     */
    public function has(string $key): bool
    {
        return isset($this->items[$key]) ?? false;
    }

    /**
     * @param $element
     */
    public function add($element)
    {
        $this->items[] = $element;
    }

    /**
     * @param array $items
     */
    public function set(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }
}
