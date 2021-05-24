<?php

namespace Mjolnir\Config;

use Mjolnir\App;
use Mjolnir\Support\Arr;

class Config
{

    /**
     * @var App
     */
    private $container;
    /**
     * @var string
     */
    private $identifier;

    public function __construct(App $container, string $identifier)
    {
        $this->container = $container;
        $this->identifier = $identifier;
    }

    public static function get(App $container, string $identifier)
    {
        return (new self($container, $identifier))->resolveIdentifier();
    }

    private function resolveIdentifier()
    {
        $keys = explode('.', $this->identifier);
        $firstKey = Arr::first($keys);
        $config = $this->container->get('config');

        if (!$config->has($firstKey)) {
            return null;
        }

        $identifierWithoutFirst = implode('.', Arr::except($keys, 0));
        $items = $config->get($firstKey)
            ->toArray();

        return Arr::get($items, $identifierWithoutFirst);
    }
}
