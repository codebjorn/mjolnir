<?php

namespace Mjolnir\Gutenberg;

class BlockLoader
{
    private $container;

    public function __construct($container)
    {
        $this->setContainer($container);
        $this->requireFiles();
    }

    public static function load($container)
    {
        return new static($container);
    }

    public function setContainer($container)
    {
        $this->container = $container;
    }

    private function requireFiles()
    {
        $path = $this->container->getPath();
        $require = "{$path}/blocks/blocks.php";
        if (file_exists($require)) {
            require $require;
        }
    }
}
