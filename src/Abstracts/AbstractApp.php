<?php

namespace Mjolnir\Abstracts;

use League\Container\Container;
use Mjolnir\Container\ContainerResolver;
use Mjolnir\Gutenberg\BlockLoader;
use Mjolnir\Hooks\HookLoader;
use Mjolnir\Providers\ConfigServiceProvider;

abstract class AbstractApp extends Container
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
        $this->addServiceProviders();
        $this->loadHooks();
        $this->loadBlocks();
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

        $providers = $this->config('app.providers');
        if ($providers) {
            foreach ($providers as $provider) {
                $this->addServiceProvider($provider);
            }
        }
    }

    /**
     * @return void
     */
    private function loadHooks()
    {
        HookLoader::load($this);
    }

    /**
     * @return void
     */
    private function loadBlocks()
    {
        BlockLoader::load($this);
    }

    /**
     * @param string $identifier
     * @return mixed
     */
    public function config(string $identifier)
    {
        return $this->get('configAccessor')
            ->get($identifier);
    }
}
