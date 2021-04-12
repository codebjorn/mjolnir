<?php

namespace Mjolnir\Support;

use ArrayAccess;
use Closure;
use IteratorAggregate;

class Collection implements ArrayAccess, IteratorAggregate
{

    /**
     * @var array
     */
    private array $elements = [];

    /**
     * BaseCollection constructor.
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
     * @return $this
     */
    public function getKeys(): Collection
    {
        return new static(array_keys($this->elements));
    }

    /**
     * @return $this
     */
    public function getValues(): Collection
    {
        return new static(array_values($this->elements));
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->elements);
    }

    /**
     * @param $key
     * @param $value
     * @return self
     */
    public function set($key, $value): self
    {
        $this->offsetSet($key, $value);

        return $this;
    }

    /**
     * @param Closure $fn
     * @return $this
     */
    public function filter(Closure $fn): Collection
    {
        return new static(array_filter($this->elements, $fn, ARRAY_FILTER_USE_BOTH));
    }

    /**
     * @param $key
     * @return $this
     */
    public function unset($key): Collection
    {
        $this->offsetUnset($key);

        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function push($element): Collection
    {
        array_push($this->elements, $element);

        return $this;
    }

    /**
     * @return mixed
     */
    public function pop()
    {
        return array_pop($this->elements);
    }

    /**
     * @return mixed
     */
    public function shift()
    {
        return array_shift($this->elements);
    }

    /**
     * @param $element
     * @return $this
     */
    public function unshift($element): Collection
    {
        array_unshift($this->elements, $element);

        return $this;
    }

    /**
     * @param int $offset
     * @param int $length
     * @return $this
     */
    public function slice($offset = 0, $length = 0): Collection
    {
        return new static(array_slice($this->elements, $offset, $length, true));
    }

    /**
     * @param int $offset
     * @param int $length
     * @param array $replacement
     * @return $this
     */
    public function splice($offset = 0, $length = 0, $replacement = []): Collection
    {
        return new static(array_splice($this->elements, $offset, $length, $replacement));
    }

    /**
     * @param Closure $fn
     * @return $this
     */
    public function map(Closure $fn): Collection
    {
        $keys = array_keys($this->elements);

        $items = array_map($fn, $this->elements, $keys);

        return new static(array_combine($keys, $items));
    }

    /**
     * @param Closure $fn
     * @param null $initial
     * @return mixed|null
     */
    public function reduce(Closure $fn, $initial = null)
    {
        return array_reduce($this->elements, $fn, $initial);
    }

    /**
     * @param Closure $fn
     * @return $this
     */
    public function sort(Closure $fn): Collection
    {
        usort($this->elements, $fn);

        return $this;
    }

    /**
     * @param Closure $fn
     * @return $this
     */
    public function asort(Closure $fn): Collection
    {
        uasort($this->elements, $fn);

        return $this;
    }

    /**
     * @param Closure $fn
     * @return Collection
     */
    public function each(Closure $fn): Collection
    {
        foreach ($this->elements as $key => $item) {
            if ($fn($item, $key) === false) {
                break;
            }
        }

        return $this;
    }

    /**
     * @param $element
     * @return false|int|Str
     */
    public function search($element)
    {
        return array_search($element, $this->elements, true);
    }

    /**
     * @param $element
     * @return self
     */
    public function remove($element): self
    {
        if ($this->hasKey($element)) {
            $this->offsetUnset($element);
        } else {
            $this->offsetUnset($this->search($element));
        }

        return $this;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
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
    public function getIterator(): ArrIterator
    {
        return new ArrIterator($this->elements);
    }

    /* Exits */

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->elements;
    }

    /**
     * @param int $flags
     * @param int $depth
     * @return false|Str
     */
    public function toJson(int $flags = 0, int $depth = 512)
    {
        return json_encode($this->elements, $flags, $depth);
    }

    /**
     * @param Str $key
     * @return bool
     */
    public function has(Str $key): bool
    {
        return array_key_exists($key, $this->elements);
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasKey($key): bool
    {
        return array_key_exists($key, $this->elements);
    }

    /**
     * @return bool
     */
    public function hasKeys(): bool
    {
        return count($this->getKeys()) > 0;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

}
