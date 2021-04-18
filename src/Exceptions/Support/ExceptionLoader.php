<?php

namespace Mjolnir\Exceptions\Support;

use Mjolnir\Contracts\AppInterface;
use Mjolnir\Contracts\ExceptionHandlerInterface;
use Mjolnir\Contracts\ExceptionLoggerInterface;

class ExceptionLoader
{
    private AppInterface $app;

    public function __construct(AppInterface $app)
    {
        $this->setApp($app);
        $this->addToContainer();
        $this->runHandler();
    }

    public static function load(AppInterface $app)
    {
        return new static($app);
    }

    public function getApp()
    {
        return $this->app;
    }

    public function setApp($app): void
    {
        $this->app = $app;
    }

    public function getConfigs()
    {

    }

    public function addToContainer()
    {
        $container = $this->app->getContainer();

        $container->add(ExceptionLoggerInterface::class, Logger::class);
        $container->add(ExceptionHandlerInterface::class, Handler::class)
            ->addArgument(ExceptionLoggerInterface::class);
    }

    public function runHandler()
    {
        return $this->app->getContainer()
            ->get(ExceptionHandlerInterface::class);
    }
}
