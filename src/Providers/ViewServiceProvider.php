<?php

namespace Mjolnir\Providers;

use Exception;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Mjolnir\Abstracts\AbstractServiceProvider;
use Mjolnir\Abstracts\AbstractApp;
use Mjolnir\Support\Collection;
use Mjolnir\View\View;

class ViewServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
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
        $this->setTemplatesFolder();
        $this->setShares();
    }

    private function setShares() {
        $this->container->share('view', View::class)
            ->addArgument($this->container->getPath());
    }

    private function setTemplatesFolder()
    {
        Collection::make([
            'index',
            '404',
            'archive',
            'author',
            'category',
            'tag',
            'taxonomy',
            'date',
            'embed',
            'home',
            'frontpage',
            'privacypolicy',
            'page',
            'paged',
            'search',
            'single',
            'singular',
            'attachment'
        ])->each(function ($type) {
            add_filter("{$type}_template_hierarchy", function ($templates) {
                return Collection::make($templates)->map(function ($template) {
                    return "templates/{$template}";
                })->toArray();
            });
        });
    }
}