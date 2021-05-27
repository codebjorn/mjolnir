<?php

namespace Mjolnir\Support;

use ArrayAccess;
use ArrayIterator;
use CachingIterator;
use Closure;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;
use JsonSerializable;
use Mjolnir\Contracts\JsonInterface;
use Mjolnir\Contracts\ArrInterface;
use Mjolnir\Traits\Macroable;

class Collection implements ArrayAccess, Countable, IteratorAggregate, JsonSerializable, ArrInterface, JsonInterface
{
    use Macroable;

    /**
     * @var array
     */
    protected $items = [];

    public function __construct($items = [])
    {
        $this->items = $this->getArrItems($items);
    }

    /**
     * Create new collection instance.
     * @param array $items
     * @return static
     */
    public static function make(array $items = []): Collection
    {
        return new static($items);
    }

    /**
     * Return all items.
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * Collapse array.
     * @return $this
     */
    public function collapse(): Collection
    {
        return new static(Arr::collapse($this->items));
    }

    /**
     * Check if array contains key, with value.
     * @param callable|int|string $key
     * @param null $value
     * @return bool
     */
    public function contains($key, $value = null): bool
    {
        if (func_num_args() === 2) {
            return $this->contains(function ($k, $item) use ($key, $value) {
                return Arr::get($item, $key) == $value;
            });
        }

        if ($this->useAsCallable($key)) {
            return !is_null($this->first($key));
        }

        return in_array($key, $this->items);
    }

    /**
     * Get difference with given items.
     * @param callable|int|string $items
     * @return $this
     */
    public function diff($items): Collection
    {
        return new static(array_diff($this->items, $this->getArrItems($items)));
    }

    /**
     * Get difference with given array keys.
     * @param callable|int|string $items
     * @return $this
     */
    public function diffKeys($items): Collection
    {
        return new static(array_diff_key($this->items, $this->getArrItems($items)));
    }

    /**
     * Loop through array.
     * @param callable|mixed $callback
     * @return $this
     */
    public function each($callback): Collection
    {
        foreach ($this->items as $key => $item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }

        return $this;
    }

    /**
     * Create a new collection consisting of every n-th element.
     * @param int $step
     * @param int $offset
     * @return $this
     */
    public function every(int $step, int $offset = 0): Collection
    {
        $new = [];

        $position = 0;

        foreach ($this->items as $item) {
            if ($position % $step === $offset) {
                $new[] = $item;
            }

            $position++;
        }

        return new static($new);
    }

    /**
     * Get all items except for those with the specified keys.
     * @param array|callable|string|int $keys
     * @return $this
     */
    public function except($keys): Collection
    {
        $keys = is_array($keys) ? $keys : func_get_args();

        return new static(Arr::except($this->items, $keys));
    }

    /**
     * Run a filter over each of the items.
     * @param callable|null $callback
     * @return $this
     */
    public function filter(callable $callback = null): Collection
    {
        if ($callback) {
            $return = [];

            foreach ($this->items as $key => $value) {
                if ($callback($value, $key)) {
                    $return[$key] = $value;
                }
            }

            return new static($return);
        }

        return new static(array_filter($this->items));
    }

    /**
     *  Filter items by the given key value pair.
     * @param string|int $key
     * @param mixed $value
     * @param bool $strict
     * @return $this
     */
    public function where($key, $value, bool $strict = true): Collection
    {
        return $this->filter(function ($item) use ($key, $value, $strict) {
            return $strict ? Arr::get($item, $key) === $value
                : Arr::get($item, $key) == $value;
        });
    }

    /**
     * Filter items by the given key value pair using loose comparison.
     * @param string|int $key
     * @param mixed $value
     * @return $this
     */
    public function whereLoose($key, $value): Collection
    {
        return $this->where($key, $value, false);
    }

    /**
     * Filter items by the given key value pair.
     * @param string|int $key
     * @param array $values
     * @param bool $strict
     * @return $this
     */
    public function whereIn($key, array $values, bool $strict = true): Collection
    {
        return $this->filter(function ($item) use ($key, $values, $strict) {
            return in_array(Arr::get($item, $key), $values, $strict);
        });
    }

    /**
     * Filter items by the given key value pair using loose comparison.
     * @param string|int $key
     * @param array $values
     * @return $this
     */
    public function whereInLoose($key, array $values): Collection
    {
        return $this->whereIn($key, $values, false);
    }

    /**
     * Get the first item from the collection.
     * @param callable|null $callback
     * @param int|null $default
     * @return false|mixed
     */
    public function first(callable $callback = null, int $default = null)
    {
        return Arr::first($this->items, $callback, $default);
    }

    /**
     * Get a flattened array of the items in the collection.
     * @param mixed $depth
     * @return $this
     */
    public function flatten($depth = INF): Collection
    {
        return new static(Arr::flatten($this->items, $depth));
    }

    /**
     * Flip the items in the collection.
     * @return $this
     */
    public function flip(): Collection
    {
        return new static(array_flip($this->items));
    }

    /**
     *  Remove an item from the collection by key.
     * @param string|int|array $keys
     * @return $this
     */
    public function forget($keys): Collection
    {
        foreach ((array)$keys as $key) {
            $this->offsetUnset($key);
        }

        return $this;
    }

    /**
     * Get an item from the collection by key.
     * @param mixed $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return Arr::get($this->items, $key, $default);
    }

    /**
     * Group an associative array by a field or using a callback.
     * @param callable|string $groupBy
     * @param bool $preserveKeys
     * @return $this
     */
    public function groupBy($groupBy, bool $preserveKeys = false): Collection
    {
        $groupBy = $this->valueRetriever($groupBy);

        $results = [];

        foreach ($this->items as $key => $value) {
            $groupKeys = $groupBy($value, $key);

            if (!is_array($groupKeys)) {
                $groupKeys = [$groupKeys];
            }

            foreach ($groupKeys as $groupKey) {
                if (!array_key_exists($groupKey, $results)) {
                    $results[$groupKey] = new static();
                }

                $results[$groupKey]->offsetSet($preserveKeys ? $key : null, $value);
            }
        }

        return new static($results);
    }

    /**
     * Key an associative array by a field or using a callback.
     * @param callable|string $keyBy
     * @return $this
     */
    public function keyBy($keyBy): Collection
    {
        $keyBy = $this->valueRetriever($keyBy);

        $results = [];

        foreach ($this->items as $item) {
            $results[$keyBy($item)] = $item;
        }

        return new static($results);
    }

    /**
     * Determine if an item exists in the collection by key.
     * @param string|int $key
     * @return bool
     */
    public function has($key): bool
    {
        return $this->offsetExists($key);
    }

    /**
     * Concatenate values of a given key as a string.
     * @param string $value
     * @param string $glue
     * @return string
     */
    public function implode(string $value, string $glue = ', '): string
    {
        $first = $this->first();

        if (is_array($first) || is_object($first)) {
            return implode($glue, $this->pluck($value)->all());
        }

        return implode($value, $this->items);
    }

    /**
     * Intersect the collection with the given items.
     * @param mixed $items
     * @return $this
     */
    public function intersect($items): Collection
    {
        return new static(array_intersect($this->items, $this->getArrItems($items)));
    }

    /**
     * Determine if the collection is empty.
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * Determine if the collection is not empty.
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    /**
     * Determine if the given value is callable, but not a string.
     * @param mixed $value
     * @return bool
     */
    protected function useAsCallable($value): bool
    {
        return !is_string($value) && is_callable($value);
    }

    /**
     * Get the keys of the collection items.
     * @return $this
     */
    public function keys(): Collection
    {
        return new static(array_keys($this->items));
    }

    /**
     * Get the last item from the collection.
     * @param callable|null $callback
     * @param null $default
     * @return false|mixed
     */
    public function last(callable $callback = null, $default = null)
    {
        return Arr::last($this->items, $callback, $default);
    }

    /**
     * Get the values of a given key.
     * @param string $value
     * @param string|null $key
     * @return $this
     */
    public function pluck(string $value, string $key = null): Collection
    {
        return new static(Arr::pluck($this->items, $value, $key));
    }

    /**
     * Run a map over each of the items.
     * @param callable $callback
     * @return $this
     */
    public function map(callable $callback): Collection
    {
        $keys = array_keys($this->items);

        $items = array_map($callback, $this->items, $keys);

        return new static(array_combine($keys, $items));
    }

    /**
     * Get the max value of a given key.
     * @param string|int|null $key
     * @return mixed|null
     */
    public function max($key = null)
    {
        return $this->reduce(function ($result, $item) use ($key) {
            $value = Arr::get($item, $key);

            return is_null($result) || $value > $result ? $value : $result;
        });
    }

    /**
     * Merge the collection with the given items.
     * @param mixed $items
     * @return $this
     */
    public function merge($items): Collection
    {
        return new static(array_merge($this->items, $this->getArrItems($items)));
    }

    /**
     * Create a collection by using this collection for keys and another for its values.
     * @param mixed $values
     * @return $this
     */
    public function combine($values): Collection
    {
        return new static(array_combine($this->all(), $this->getArrItems($values)));
    }

    /**
     * Union the collection with the given items.
     * @param mixed $items
     * @return $this
     */
    public function union($items): Collection
    {
        return new static($this->items + $this->getArrItems($items));
    }

    /**
     * Get the min value of a given key.
     * @param string|int|null $key
     * @return mixed|null
     */
    public function min($key = null)
    {
        return $this->reduce(function ($result, $item) use ($key) {
            $value = Arr::get($item, $key);

            return is_null($result) || $value < $result ? $value : $result;
        });
    }

    /**
     * Get the items with the specified keys.
     * @param array|string|int $keys
     * @return $this
     */
    public function only($keys): Collection
    {
        $keys = is_array($keys) ? $keys : func_get_args();

        return new static(Arr::only($this->items, $keys));
    }

    /**
     * "Paginate" the collection by slicing it into a smaller collection.
     * @param int $page
     * @param int $perPage
     * @return $this
     */
    public function forPage(int $page, int $perPage): Collection
    {
        return $this->slice(($page - 1) * $perPage, $perPage);
    }

    /**
     * Get and remove the last item from the collection.
     * @return mixed|null
     */
    public function pop()
    {
        return array_pop($this->items);
    }

    /**
     * Push an item onto the beginning of the collection.
     * @param mixed $value
     * @param null $key
     * @return $this
     */
    public function prepend($value, $key = null): Collection
    {
        $this->items = Arr::prepend($this->items, $value, $key);

        return $this;
    }

    /**
     * Push an item onto the end of the collection.
     * @param mixed $value
     * @return $this
     */
    public function push($value): Collection
    {
        $this->offsetSet(null, $value);

        return $this;
    }

    /**
     * Get and remove an item from the collection.
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function pull($key, $default = null)
    {
        return Arr::pull($this->items, $key, $default);
    }

    /**
     * Put an item in the collection by key..
     * @param string|int $key
     * @param mixed $value
     * @return $this
     */
    public function put($key, $value): Collection
    {
        $this->offsetSet($key, $value);

        return $this;
    }

    /**
     * Get one or more items randomly from the collection.
     * @param int $amount
     * @return $this|mixed
     */
    public function random(int $amount = 1)
    {
        if ($amount > ($count = $this->count())) {
            throw new InvalidArgumentException("You requested {$amount} items, but there are only {$count} items in the collection");
        }

        $keys = array_rand($this->items, $amount);

        if ($amount == 1) {
            return $this->items[$keys];
        }

        return new static(array_intersect_key($this->items, array_flip($keys)));
    }

    /**
     * Reduce the collection to a single value.
     * @param callable $callback
     * @param mixed $initial
     * @return mixed|null
     */
    public function reduce(callable $callback, $initial = null)
    {
        return array_reduce($this->items, $callback, $initial);
    }

    /**
     * Create a collection of all elements that do not pass a given truth test.
     * @param callable|string|int $callback
     * @return $this
     */
    public function reject($callback): Collection
    {
        if ($this->useAsCallable($callback)) {
            return $this->filter(function ($value, $key) use ($callback) {
                return !$callback($value, $key);
            });
        }

        return $this->filter(function ($item) use ($callback) {
            return $item != $callback;
        });
    }

    /**
     * Reverse items order.
     * @return $this
     */
    public function reverse(): Collection
    {
        return new static(array_reverse($this->items, true));
    }

    /**
     * Search the collection for a given value and return the corresponding key if successful.
     * @param mixed $value
     * @param false $strict
     * @return false|int|string
     */
    public function search($value, bool $strict = false)
    {
        if (!$this->useAsCallable($value)) {
            return array_search($value, $this->items, $strict);
        }

        foreach ($this->items as $key => $item) {
            if (call_user_func($value, $item, $key)) {
                return $key;
            }
        }

        return false;
    }

    /**
     * Get and remove the first item from the collection.
     * @return mixed|null
     */
    public function shift()
    {
        return array_shift($this->items);
    }

    /**
     * @return $this
     */
    public function shuffle(): Collection
    {
        $items = $this->items;

        shuffle($items);

        return new static($items);
    }

    /**
     * Shuffle the items in the collection.
     * @param $offset
     * @param null $length
     * @return $this
     */
    public function slice($offset, $length = null): Collection
    {
        return new static(array_slice($this->items, $offset, $length, true));
    }

    /**
     * Slice the underlying collection array.
     * @param int $size
     * @return $this
     */
    public function chunk(int $size): Collection
    {
        $chunks = [];

        foreach (array_chunk($this->items, $size, true) as $chunk) {
            $chunks[] = new static($chunk);
        }

        return new static($chunks);
    }

    /**
     * Sort through each item with a callback.
     * @param callable|null $callback
     * @return $this
     */
    public function sort(callable $callback = null): Collection
    {
        $items = $this->items;

        $callback ? uasort($items, $callback) : uasort($items, function ($a, $b) {
            if ($a == $b) {
                return 0;
            }

            return ($a < $b) ? -1 : 1;
        });

        return new static($items);
    }

    /**
     * Sort the collection using the given callback.
     * @param callable|string $callback
     * @param int $options
     * @param false $descending
     * @return $this
     */
    public function sortBy($callback, int $options = SORT_REGULAR, bool $descending = false): Collection
    {
        $results = [];

        $callback = $this->valueRetriever($callback);

        foreach ($this->items as $key => $value) {
            $results[$key] = $callback($value, $key);
        }

        $descending ? arsort($results, $options)
            : asort($results, $options);

        foreach (array_keys($results) as $key) {
            $results[$key] = $this->items[$key];
        }

        return new static($results);
    }

    /**
     * Sort the collection in descending order using the given callback.
     * @param callable|string $callback
     * @param int $options
     * @return $this
     */
    public function sortByDesc($callback, int $options = SORT_REGULAR): Collection
    {
        return $this->sortBy($callback, $options, true);
    }

    /**
     * Splice a portion of the underlying collection array.
     * @param int $offset
     * @param int|null $length
     * @param array $replacement
     * @return $this
     */
    public function splice(int $offset, int $length = null, array $replacement = []): Collection
    {
        if (func_num_args() == 1) {
            return new static(array_splice($this->items, $offset));
        }

        return new static(array_splice($this->items, $offset, $length, $replacement));
    }

    /**
     * Get the sum of the given values.
     * @param null $callback
     * @return float|int|mixed|null
     */
    public function sum($callback = null)
    {
        if (is_null($callback)) {
            return array_sum($this->items);
        }

        $callback = $this->valueRetriever($callback);

        return $this->reduce(function ($result, $item) use ($callback) {
            return $result += $callback($item);
        }, 0);
    }

    /**
     * Take the first or last {$limit} items.
     * @param int $limit
     * @return $this
     */
    public function take(int $limit): Collection
    {
        if ($limit < 0) {
            return $this->slice($limit, abs($limit));
        }

        return $this->slice(0, $limit);
    }

    /**
     * Transform each item in the collection using a callback.
     * @param callable $callback
     * @return $this
     */
    public function transform(callable $callback): Collection
    {
        $this->items = $this->map($callback)->all();

        return $this;
    }

    /**
     * Pass the collection to the given callback and then return it.
     * @param callable $callback
     * @return $this
     */
    public function tap(callable $callback): Collection
    {
        $callback(new static($this->items));

        return $this;
    }

    /**
     * Return only unique items from the collection array.
     * @param string|int|null $key
     * @param bool|false $strict
     * @return $this
     */
    public function unique($key = null, bool $strict = false): Collection
    {
        if (is_null($key)) {
            return new static(array_unique($this->items, SORT_REGULAR));
        }

        $callback = $this->valueRetriever($key);

        $exists = [];

        return $this->reject(function ($item, $key) use ($callback, $strict, &$exists) {
            if (in_array($id = $callback($item, $key), $exists, $strict)) {
                return true;
            }

            $exists[] = $id;
        });
    }

    /**
     * Return only unique items from the collection array using strict comparison.
     * @param string|callable|null $key
     * @return $this
     */
    public function uniqueStrict($key = null): Collection
    {
        return $this->unique($key, true);
    }

    /**
     * Reset the keys on the underlying array.
     * @return $this
     */
    public function values(): Collection
    {
        return new static(array_values($this->items));
    }

    /**
     * Get a value retrieving callback.
     * @param string|callable $value
     * @return Closure
     */
    protected function valueRetriever($value)
    {
        if ($this->useAsCallable($value)) {
            return $value;
        }

        return function ($item) use ($value) {
            return Arr::get($item, $value);
        };
    }

    /**
     * Zip the collection together with one or more arrays.
     * @param mixed $items
     * @return $this
     */
    public function zip($items): Collection
    {
        $arrayableItems = array_map(function ($items) {
            return $this->getArrItems($items);
        }, func_get_args());

        $params = array_merge([function () {
            return new static(func_get_args());
        }, $this->items], $arrayableItems);

        return new static(call_user_func_array('array_map', $params));
    }

    /**
     * Get the collection of items as a plain array.
     * @return array
     */
    public function toArray(): array
    {
        return array_map(function ($value) {
            return $value instanceof ArrInterface ? $value->toArray() : $value;
        }, $this->items);
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array_map(function ($value) {
            if ($value instanceof JsonSerializable) {
                return $value->jsonSerialize();
            } elseif ($value instanceof JsonInterface) {
                return json_decode($value->toJson(), true);
            } elseif ($value instanceof ArrInterface) {
                return $value->toArray();
            } else {
                return $value;
            }
        }, $this->items);
    }

    /**
     * Get the collection of items as JSON.
     * @param int $options
     * @return string
     */
    public function toJson(int $options = 0): string
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Get an iterator for the items.
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Get a CachingIterator instance.
     * @param int $flags
     * @return CachingIterator
     */
    public function getCachingIterator(int $flags = CachingIterator::CALL_TOSTRING): CachingIterator
    {
        return new CachingIterator($this->getIterator(), $flags);
    }

    /**
     * Count the number of items in the collection.
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Determine if an item exists at an offset.
     * @param mixed $key
     * @return bool
     */
    public function offsetExists($key): bool
    {
        return array_key_exists($key, $this->items);
    }

    /**
     * Get an item at a given offset.
     * @param mixed $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->items[$key];
    }

    /**
     * Set the item at a given offset.
     * @param mixed $key
     * @param mixed $value
     */
    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    /**
     * Unset the item at a given offset.
     * @param mixed $key
     */
    public function offsetUnset($key)
    {
        unset($this->items[$key]);
    }

    /**
     * Convert the collection to its string representation.
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * Results array of items from Collection or ArrInterface.
     * @param $items
     * @return array
     */
    protected function getArrItems($items): array
    {
        if (is_array($items)) {
            return $items;
        } elseif ($items instanceof self) {
            return $items->all();
        } elseif ($items instanceof ArrInterface) {
            return $items->toArray();
        } elseif ($items instanceof JsonInterface) {
            return json_decode($items->toJson(), true);
        } elseif ($items instanceof JsonSerializable) {
            return $items->jsonSerialize();
        }

        return (array)$items;
    }
}
