<?php

namespace Mjolnir\Config;

use Mjolnir\Abstracts\AbstractApp;
use Mjolnir\Support\Arr;
use Mjolnir\Support\Collection;

class Config
{

    /**
     * @var AbstractApp
     */
    private $container;

    public function __construct(AbstractApp $container)
    {
        $this->container = $container;
    }

    public function get(string $identifier)
    {
        return $this->resolveIdentifier($identifier);
    }

    private function resolveIdentifier(string $identifier)
    {
        $keys = Collection::make(explode('.', $identifier));
        $config = $this->container->get('config');

        if (!$config->has($keys->first())) {
            return null;
        }

        if ($keys->count() === 1) {
            return $config->get($keys->first())
                ->toArray();
        }

        $identifierWithoutFirst = $keys->except(0)->implode('.');
        $items = $config->get($keys->first())
            ->toArray();

        return Arr::get($items, $identifierWithoutFirst);
    }
}
