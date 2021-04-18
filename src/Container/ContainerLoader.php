<?php

namespace Mjolnir\Container;

use Mjolnir\Contracts\AppInterface;
use Mjolnir\Contracts\ConfigRepositoryInterface;
use Mjolnir\Contracts\LoaderInterface;

class ContainerLoader implements LoaderInterface
{
    private AppInterface $app;

    /**
     * ContainerLoader constructor.
     * @param AppInterface $app
     */
    public function __construct(AppInterface $app)
    {
        $this->setApp($app);
        $this->addServiceProviders();
        $this->addAliases();
    }

    /**
     * @param AppInterface $app
     * @return static
     */
    public static function load(AppInterface $app)
    {
        return new static($app);
    }

    /**
     * @param $app
     */
    public function setApp($app): void
    {
        $this->app = $app;
    }

    private function addServiceProviders()
    {
        $providers = $this->app->getContainer()
            ->get(ConfigRepositoryInterface::class)
            ->getKey('services')
            ->getKey('providers');

        if ($providers) {
            foreach ($providers as $provider) {
                $this->app->getContainer()
                    ->addServiceProvider($provider);
            }
        }
    }

    private function addAliases()
    {
        $aliases = $this->app->getContainer()
            ->get(ConfigRepositoryInterface::class)
            ->getKey('services')
            ->getKey('aliases');

        if ($aliases) {
            foreach ($aliases as $alias => $class) {
                $this->app->getContainer()
                    ->extend($class)
                    ->setAlias($alias);
            }
        }
    }
}
