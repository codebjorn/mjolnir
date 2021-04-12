<?php

namespace Mjolnir\Container;


use League\Container\Container as LeagueContainer;
use League\Container\ReflectionContainer;
use League\Container\ServiceProvider\ServiceProviderAggregateInterface;
use Psr\Container\ContainerInterface;

class Container extends LeagueContainer
{
    /**
     * @var ServiceProviderAggregateInterface
     */
    protected $providers;

    /**
     * @var ContainerInterface[]
     */
    protected $delegates = [];

    public function __construct()
    {
        parent::__construct();
        $this->delegates = [
            (new ReflectionContainer())->cacheResolutions()
        ];
    }
}
