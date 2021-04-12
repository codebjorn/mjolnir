<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Support\Collection;
use Mjolnir\Support\Is;
use Mjolnir\Traits\QueryParameterable;

class Tax
{
    use QueryParameterable;

    private ?string $relation;
    private ?array $arguments;

    public function __construct(string $relation = null, array $arguments = null)
    {
        $this->relation = $relation;
        $this->arguments = $arguments;
    }

    /**
     * @return string|null
     */
    public function getRelation(): ?string
    {
        return $this->relation;
    }

    /**
     * @return array|null
     */
    public function getArguments(): ?array
    {
        return $this->arguments;
    }

    /**
     * @param string|null $relation
     */
    public function setRelation(?string $relation): void
    {
        $this->relation = $relation;
    }

    /**
     * @param array|null $arguments
     */
    public function setArguments(?array $arguments): void
    {
        $this->arguments = $arguments;
    }

    public function toArray()
    {
        $props = Collection::make(get_class_vars(static::class));
        $resolvedProps = $props->map(function ($item, $index) {
            if (Is::arr($this->{$index})) {
                return Collection::make($this->{$index})
                    ->map(fn($class) => Is::obj($class) ? $class->toArray() : $class)
                    ->toArray();
            }

            return $this->{$index};
        });

        return [
            'tax_query' => [
                'relation' => $resolvedProps->get('relation'),
                $resolvedProps->get('arguments')
            ]
        ];
    }
}
