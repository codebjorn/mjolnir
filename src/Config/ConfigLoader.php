<?php

namespace Mjolnir\Config;

use Exception;
use Mjolnir\Contracts\AppInterface;
use Mjolnir\Contracts\ConfigRepositoryInterface;
use Mjolnir\Contracts\LoaderInterface;

class ConfigLoader implements LoaderInterface
{
    private AppInterface $app;

    /**
     * ConfigLoader constructor.
     * @param AppInterface $app
     * @throws Exception
     */
    public function __construct(AppInterface $app)
    {
        $this->setApp($app);
        $this->addToContainer();
    }

    /**
     * @param AppInterface $app
     * @return static
     * @throws Exception
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

    /**
     * @return array
     * @throws Exception
     */
    public function getConfigs()
    {
        $path = $this->app->getPath();
        return ConfigFactory::make(['path' => "{$path}/config"])
            ->getInstances();
    }

    /**
     * @throws Exception
     */
    public function addToContainer()
    {
        $container = $this->app->getContainer();
        $container->add(ConfigRepositoryInterface::class, ConfigRepository::class, true)
            ->addArgument($this->getConfigs());
    }
}
