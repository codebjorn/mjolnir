<?php

namespace Mjolnir\Gutenberg;

use Mjolnir\Abstracts\AbstractApp;

class BlockLoader
{
    /**
     * @var AbstractApp
     */
    private $container;

    /**
     * BlockLoader constructor.
     * @param $container
     */
    public function __construct($container)
    {
        $this->setContainer($container);
        $this->requireFiles();
    }

    /**
     * @param $container
     * @return static
     */
    public static function load($container): BlockLoader
    {
        return new static($container);
    }

    /**
     * @param $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    /**
     *
     */
    private function requireFiles()
    {
        $path = $this->container->getPath();
        $require = "{$path}/blocks/blocks.php";
        if (file_exists($require)) {
            require $require;
        }
    }
}
