<?php

namespace Mjolnir\Providers;

use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Mjolnir\Abstracts\AbstractServiceProvider;
use Mjolnir\App;
use Mjolnir\Contracts\ExceptionHandlerInterface;
use Mjolnir\Contracts\ExceptionLoggerInterface;
use Mjolnir\Exceptions\Support\Handler;
use Mjolnir\Exceptions\Support\Logger;

class ExceptionServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    /**
     * @var App
     */
    protected $container;

    /**
     *
     */
    public function register()
    {
        //
    }

    /**
     *
     */
    public function boot()
    {
        $this->container->add(ExceptionLoggerInterface::class, Logger::class);
        $this->container->add(ExceptionHandlerInterface::class, Handler::class)
            ->addArgument(ExceptionLoggerInterface::class);

        $this->runExceptionHandler();
    }

    /**
     *
     */
    private function runExceptionHandler()
    {
        $this->container->get(ExceptionHandlerInterface::class);
    }

}