<?php

namespace Mjolnir\Traits;

use Mjolnir\Support\Collection;

trait QueryParameter
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        $props = Collection::make(get_class_vars(static::class));
        return $props->map(function ($item, $index) {
            return $this->{$index};
        })
            ->filter(function ($item) {
                return $item !== null;
            })
            ->toArray();
    }
}
