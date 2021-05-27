<?php

namespace Mjolnir\Providers;

use Exception;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Mjolnir\Abstracts\AbstractServiceProvider;
use Mjolnir\Abstracts\AbstractApp;
use Mjolnir\Hooks\Action;
use Mjolnir\Hooks\Filter;
use Mjolnir\Hooks\HookRepository;

class HooksServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    /** @var AbstractApp */
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
        $this->container->share('hooks', HookRepository::class);
        $this->container->share('action', Action::class)
            ->addArguments(['app' => $this->container, 'action' => 'add_action']);
        $this->container->share('filter', Filter::class)
            ->addArguments(['app' => $this->container, 'action' => 'add_filter']);
    }
}
