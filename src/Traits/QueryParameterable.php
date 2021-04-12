<?php

namespace Mjolnir\Traits;

use Mjolnir\Support\Collection;

trait QueryParameterable
{
    /**
     * @return array
     */
    public function toArray()
    {
        $props = Collection::make(get_class_vars(static::class));
        return $props->map(fn($item, $index) => $this->{$index})
            ->filter(fn($item) => $item !== null)
            ->toArray();
    }
}
