<?php

namespace Mjolnir\Abstracts;

use Mjolnir\Traits\Instantiable;

abstract class AbstractRepository
{
    use Instantiable;

    private array $storage;

    public function __construct($storage = [])
    {
        $this->storage = $storage;
    }

    public function get(): array
    {
        return $this->storage;
    }

    public function getKey(string $key)
    {
        return $this->storage[$key] ?? false;
    }


    public function add($element): void
    {
        $this->storage[] = $element;
    }

    public function set(array $storage): void
    {
        $this->storage = $storage;
    }
}
