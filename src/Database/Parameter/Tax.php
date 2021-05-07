<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Support\Collection;
use Mjolnir\Support\Is;
use Mjolnir\Traits\QueryParameter;

class Tax
{
    use QueryParameter;

    /**
     * @var string|null
     */
    private $relation;
    /**
     * @var array|null
     */
    private $arguments;

    /**
     * Tax constructor.
     * @param string|null $relation
     * @param array|null $arguments
     */
    public function __construct(string $relation = null, array $arguments = null)
    {
        $this->relation = $relation;
        $this->arguments = $arguments;
    }

    /**
     * @return string|null
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * @return array|null
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param string|null $relation
     */
    public function setRelation($relation)
    {
        $this->relation = $relation;
    }

    /**
     * @param array|null $arguments
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
    }

    /**
     * @return array[]
     */
    public function toArray(): array
    {
        $props = Collection::make(get_class_vars(static::class));
        $resolvedProps = $props->map(function ($item, $index) {
            if (Is::arr($this->{$index})) {
                return Collection::make($this->{$index})
                    ->map(function ($class) {
                        return Is::obj($class) ? $class->toArray() : $class;
                    })
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
