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

    private function setShares()
    {
        $this->container->share('view', View::class)
            ->addArguments([
                'templatePath' => [
                    $this->container->config('app.view.templatePath'),
                    $this->container->getPath() . "/{$this->container->config('app.blocks.folder')}"
                ],
                'compiledPath' => $this->container->config('app.view.compiledPath'),
            ]);
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
            $this->container->get('filter')
                ->add("{$type}_template_hierarchy", function ($templates) {
                    return Collection::make($templates)->map(function ($template) {
                        $templatesFolder = $this->container->config('app.view.templatesFolder') ?? "templates";
                        return "{$templatesFolder}/{$template}";
                    })->toArray();
                });
        });
    }
}
