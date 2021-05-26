<?php

namespace Mjolnir\Providers;

use Exception;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Mjolnir\Abstracts\AbstractServiceProvider;
use Mjolnir\App;
use Mjolnir\View\View;

class ViewServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
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
        $this->container->share('view', View::class)
            ->addArgument($this->container->getPath());
    }
}
