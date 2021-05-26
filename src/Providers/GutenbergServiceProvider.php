<?php

namespace Mjolnir\Providers;

use Exception;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Mjolnir\Abstracts\AbstractServiceProvider;
use Mjolnir\App;
use Mjolnir\Gutenberg\Block;

class GutenbergServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
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
        $this->container->share('block', Block::class)
            ->addArguments(['view' => $this->container->get('view'), 'path' => $this->container->getPath()]);
    }
}
