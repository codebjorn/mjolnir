<?php

namespace Mjolnir\Providers;

use Exception;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Mjolnir\Abstracts\AbstractServiceProvider;
use Mjolnir\Abstracts\AbstractApp;
use Mjolnir\Gutenberg\Block;

class GutenbergServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
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
        $blocksSSR = $this->container->config('app.blocks.useSSR') ?? true;
        $blocksFolder = $this->container->config('app.blocks.folder') ?? "blocks";

        if (!$blocksSSR) {
            return;
        }

        $this->container->share('block', Block::class)
            ->addArguments([
                'view' => $this->container->get('view'),
                'path' => $this->container->getPath() . "/{$blocksFolder}"
            ]);
    }
}
