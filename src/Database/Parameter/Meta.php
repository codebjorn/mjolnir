<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Support\Collection;
use Mjolnir\Support\Is;
use Mjolnir\Traits\QueryParameter;

class Meta
{
    use QueryParameter;

    /**
     * @var array|null
     */
    private $meta_query;
    /**
     * @var string|null
     */
    private $meta_key;
    /**
     * @var string|null
     */
    private $meta_value;
    /**
     * @var string|null
     */
    private $meta_value_num;
    /**
     * @var string|null
     */
    private $meta_compare;

    /**
     * Meta constructor.
     * @param array|null $meta_query
     * @param string|null $meta_key
     * @param string|null $meta_value
     * @param string|null $meta_value_num
     * @param string|null $meta_compare
     */
    public function __construct(array $meta_query = null, string $meta_key = null, string $meta_value = null, string $meta_value_num = null, string $meta_compare = null)
    {
        $this->meta_query = $meta_query;
        $this->meta_key = $meta_key;
        $this->meta_value = $meta_value;
        $this->meta_value_num = $meta_value_num;
        $this->meta_compare = $meta_compare;
    }

    /**
     * @return array|null
     */
    public function getMetaQuery()
    {
        return $this->meta_query;
    }

    /**
     * @param array|null $meta_query
     */
    public function setMetaQuery($meta_query)
    {
        $this->meta_query = $meta_query;
    }

    /**
     * @return string|null
     */
    public function getMetaKey()
    {
        return $this->meta_key;
    }

    /**
     * @param string|null $meta_key
     */
    public function setMetaKey($meta_key)
    {
        $this->meta_key = $meta_key;
    }

    /**
     * @return string|null
     */
    public function getMetaValue()
    {
        return $this->meta_value;
    }

    /**
     * @param string|null $meta_value
     */
    public function setMetaValue($meta_value)
    {
        $this->meta_value = $meta_value;
    }

    /**
     * @return string|null
     */
    public function getMetaValueNum()
    {
        return $this->meta_value_num;
    }

    /**
     * @param string|null $meta_value_num
     */
    public function setMetaValueNum($meta_value_num)
    {
        $this->meta_value_num = $meta_value_num;
    }

    /**
     * @return string|null
     */
    public function getMetaCompare()
    {
        return $this->meta_compare;
    }

    /**
     * @param string|null $meta_compare
     */
    public function setMetaCompare($meta_compare)
    {
        $this->meta_compare = $meta_compare;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $props = Collection::make(get_class_vars(static::class));
        $resolvedProps = $props->map(function ($item, $index) {
            if ($index === "meta_query") {
                return Collection::make($this->{$index} ?? [])
                    ->map(function ($class) {
                        return Is::obj($class) ? $class->toArray() : $class;
                    })
                    ->toArray();
            }

            return $this->{$index};
        });

        return $resolvedProps->filter(function ($item) {
            return $item !== null;
        })
            ->toArray();
    }
}
