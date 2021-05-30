<?php

namespace Mjolnir\Providers;

use Exception;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Mjolnir\Abstracts\AbstractServiceProvider;
use Mjolnir\Abstracts\AbstractApp;
use Mjolnir\Support\Arr;
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
        $blocksSSR = $this->container->config('app.blocks.useSSR') ?? true;
        $blocksFolder = $this->container->config('app.blocks.folder') ?? "blocks";
        $templatePath = [$this->container->config('app.view.templatePath')];

        if ($blocksSSR) {
            $templatePath = Arr::prepend($templatePath, $this->container->getPath() . "/{$blocksFolder}");
        }

        $this->container->share('view', View::class)
            ->addArguments([
                'templatePath' => $templatePath,
                'compiledPath' => $this->container->config('app.view.compiledPath'),
                'baseUrl' => $this->container->config('app.uri.base')
            ]);
    }

    private function setTemplatesFolder()
    {
        $templatesFolder = $this->container->config('theme.templates.folder');

        if (!$templatesFolder) {
            return;
        }

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
        ])->each(function ($type) use ($templatesFolder) {
            $this->container->get('filter')
                ->add("{$type}_template_hierarchy", function ($templates) use ($templatesFolder) {
                    return Collection::make($templates)->map(function ($template) use ($templatesFolder) {
                        return "{$templatesFolder}/{$template}";
                    })->toArray();
                });
        });
    }
}
