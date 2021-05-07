<?php

namespace Mjolnir\Providers;

use Exception;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Mjolnir\Abstracts\AbstractServiceProvider;
use Mjolnir\App;
use Mjolnir\Config\ConfigFactory;
use Mjolnir\Config\ConfigRepository;

class ConfigServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    /** @var App */
    protected $container;

    public function register()
    {
        //
    }

    /**
     * @throws Exception
     */
    public function boot()
    {
        $basename = 'config';

        $this->container->add($basename, ConfigRepository::class, true)
            ->addArgument($this->configs());

        foreach ($this->container->get($basename) as $key => $config) {
            $this->container->add("{$basename}.{$key}", function () use ($basename, $key) {
                return $this->container->get($basename)->get($key);
            }, true);
        }
    }

    /**
     * @return array
     * @throws Exception
     */
    public function configs(): array
    {
        $path = $this->container->getPath();
        return ConfigFactory::make(['path' => "{$path}/config"])
            ->getInstances();
    }
}