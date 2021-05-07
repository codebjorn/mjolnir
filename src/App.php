<?php

namespace Mjolnir;

use League\Container\Container;
use Mjolnir\Container\ContainerResolver;
use Mjolnir\Hooks\HookLoader;
use Mjolnir\Hooks\HookRepository;
use Mjolnir\Providers\ConfigServiceProvider;
use Mjolnir\Providers\ExceptionServiceProvider;

class App extends Container
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
        $this->share('hooks', HookRepository::class);
    }

    /**
     * @return void
     */
    private function addServiceProviders()
    {
        $this->addServiceProvider(ConfigServiceProvider::class);
        $this->addServiceProvider(ExceptionServiceProvider::class);

        $providers = $this->get('config.app')->get('providers');
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

}
