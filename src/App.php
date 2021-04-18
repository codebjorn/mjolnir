<?php

namespace Mjolnir;

use Mjolnir\Config\ConfigLoader;
use Mjolnir\Container\Container;
use Mjolnir\Container\ContainerLoader;
use Mjolnir\Contracts\AppInterface;
use Mjolnir\Exceptions\Support\ExceptionLoader;
use Mjolnir\Hooks\HookLoader;
use Psr\Container\ContainerInterface;

class App implements AppInterface
{
    protected static $instance;
    protected ContainerInterface $container;
    protected string $path;
    protected array $loaders = [
        ExceptionLoader::class,
        ConfigLoader::class,
        ContainerLoader::class,
        HookLoader::class
    ];

    public function __construct(string $path = null)
    {
        $this->setInstance($this);
        $this->setPath($path);
        $this->setContainer();
        $this->load();
    }

    public static function boot(string $path = null)
    {
        return new static($path);
    }

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    public function setPath(?string $path)
    {
        $this->path = $path ?? dirname(__DIR__);
    }

    public function setContainer()
    {
        $this->container = new Container();
    }

    public function setInstance(AppInterface $app = null)
    {
        return static::$instance = $app;
    }

    public function load()
    {
        foreach ($this->loaders as $loader) {
            call_user_func([$loader, 'load'], $this);
        }
    }


}
