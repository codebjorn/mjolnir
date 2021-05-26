<?php

namespace Mjolnir;

use League\Container\Container;
use Mjolnir\Config\Config;
use Mjolnir\Container\ContainerResolver;
use Mjolnir\Hooks\HookLoader;
use Mjolnir\Hooks\HookRepository;
use Mjolnir\Providers\ConfigServiceProvider;
use Mjolnir\Providers\ExceptionServiceProvider;
use Mjolnir\Providers\HooksServiceProvider;
use Mjolnir\Providers\ViewServiceProvider;
use Mjolnir\Support\Collection;
use Mjolnir\Support\Is;

abstract class App extends Container
{
    /**
     * @var string
     */
    protected $resolver = ContainerResolver::class;
    /**
     * @var string|null
     */
    protected $basePath;

    /**
     * App constructor.
     * @param null $basePath
     */
    public function __construct($basePath = null)
    {
        parent::__construct();
        $this->setPath($basePath);

        $this->addBaseShared();
        $this->setTemplatesFolder();
        $this->addServiceProviders();
        $this->loadHooks();
    }

    /**
     * @return string|null
     */
    public function getPath()
    {
        return $this->basePath;
    }

    /**
     * @param $path
     */
    public function setPath($path)
    {
        $this->basePath = $path ?? dirname(__DIR__);
    }

    /**
     * @return void
     */
    private function addBaseShared()
    {
        $this->share('resolver', ContainerResolver::class)
            ->addArguments(['container' => $this]);
    }

    /**
     * @return void
     */
    private function addServiceProviders()
    {
        $this->addServiceProvider(ConfigServiceProvider::class);
        $this->addServiceProvider(ExceptionServiceProvider::class);
        $this->addServiceProvider(ViewServiceProvider::class);
        $this->addServiceProvider(HooksServiceProvider::class);

        $providers = $this->config('app.providers');
        if ($providers) {
            foreach ($providers as $provider) {
                $this->addServiceProvider($provider);
            }
        }
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
            add_filter("{$type}_template", function ($template, $type) {
                $path = "{$this->basePath}/templates/{$type}.php";
                if (Is::file($path)) {
                    return $path;
                }
            }, 10, 2);
        });
    }


    /**
     * @return void
     */
    private function loadHooks()
    {
        HookLoader::load($this);
    }

    public function config(string $identifier)
    {
        return $this->get('configAccessor')
            ->get($identifier);
    }
}
