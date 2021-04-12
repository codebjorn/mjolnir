<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Support\Collection;
use Mjolnir\Support\Is;
use Mjolnir\Traits\QueryParameterable;

class Meta
{
    use QueryParameterable;

    private ?array $meta_query;
    private ?string $meta_key;
    private ?string $meta_value;
    private ?string $meta_value_num;
    private ?string $meta_compare;

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
    public function getMetaQuery(): ?array
    {
        return $this->meta_query;
    }

    /**
     * @param array|null $meta_query
     */
    public function setMetaQuery(?array $meta_query): void
    {
        $this->meta_query = $meta_query;
    }

    /**
     * @return string|null
     */
    public function getMetaKey(): ?string
    {
        return $this->meta_key;
    }

    /**
     * @param string|null $meta_key
     */
    public function setMetaKey(?string $meta_key): void
    {
        $this->meta_key = $meta_key;
    }

    /**
     * @return string|null
     */
    public function getMetaValue(): ?string
    {
        return $this->meta_value;
    }

    /**
     * @param string|null $meta_value
     */
    public function setMetaValue(?string $meta_value): void
    {
        $this->meta_value = $meta_value;
    }

    /**
     * @return string|null
     */
    public function getMetaValueNum(): ?string
    {
        return $this->meta_value_num;
    }

    /**
     * @param string|null $meta_value_num
     */
    public function setMetaValueNum(?string $meta_value_num): void
    {
        $this->meta_value_num = $meta_value_num;
    }

    /**
     * @return string|null
     */
    public function getMetaCompare(): ?string
    {
        return $this->meta_compare;
    }

    /**
     * @param string|null $meta_compare
     */
    public function setMetaCompare(?string $meta_compare): void
    {
        $this->meta_compare = $meta_compare;
    }

    public function toArray()
    {
        $props = Collection::make(get_class_vars(static::class));
        $resolvedProps = $props->map(function ($item, $index) {
            if ($index === "meta_query") {
                return Collection::make($this->{$index} ?? [])
                    ->map(fn($class) => Is::obj($class) ? $class->toArray() : $class)
                    ->toArray();
            }

            return $this->{$index};
        });

        return $resolvedProps->filter(fn($item) => $item !== null)
            ->toArray();
    }
}
