<?php

namespace Mjolnir\Container;

use Mjolnir\Config\ConfigRepository;
use Mjolnir\Contracts\ConfigRepositoryInterface;
use Mjolnir\Contracts\ExceptionHandlerInterface;
use Mjolnir\Contracts\ExceptionLoggerInterface;
use Mjolnir\Contracts\FactoryInterface;
use Mjolnir\Exceptions\Support\Handler;
use Mjolnir\Exceptions\Support\Logger;
use Mjolnir\Traits\Factoryable;

class ContainerFactory implements FactoryInterface
{
    use Factoryable;

    private string $path;
    private array $configs;
    private Container $container;
    private string $exceptionHandler;

    /**
     * @param array|null $parameters
     * @return static
     */
    public static function make(array $parameters = null): self
    {
        $static = new static($parameters);

        return $static->setInstance($static->container ?? new Container())
            ->attachExceptionHandler($static->exceptionHandler ?? Handler::class)
            ->attachConfigs()
            ->attachProviders()
            ->attachAliases();
    }

    /**
     * @return Container
     */
    public function getInstance(): Container
    {
        return $this->container;
    }

    /**
     * @param object|Container $instance
     * @return FactoryInterface
     */
    public function setInstance(object $instance): FactoryInterface
    {
        $this->container = $instance;

        return $this;
    }

    /**
     * @param string|null $handler
     * @return $this
     */
    private function attachExceptionHandler(string $handler = null): self
    {
        $this->container->add(ExceptionLoggerInterface::class, Logger::class);
        $this->container->add(ExceptionHandlerInterface::class, $handler)
            ->addArgument(ExceptionLoggerInterface::class);

        return $this;
    }

    /**
     * @return $this
     */
    private function attachConfigs(): self
    {
        $this->container->add(ConfigRepositoryInterface::class, ConfigRepository::class, true)
            ->addArgument($this->configs);

        return $this;
    }

    /**
     * @return $this
     */
    private function attachProviders(): self
    {
        $providers = $this->container->get(ConfigRepositoryInterface::class)
            ->get('services')
            ->get('providers');

        if ($providers) {
            foreach ($providers as $provider) {
                $this->container->addServiceProvider($provider);
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function attachAliases(): self
    {
        $aliases = $this->container->get(ConfigRepositoryInterface::class)
            ->get('services')
            ->get('aliases');

        if ($aliases) {
            foreach ($aliases as $alias => $class) {
                $this->container->extend($class)->setAlias($alias);
            }
        }

        return $this;
    }
}
