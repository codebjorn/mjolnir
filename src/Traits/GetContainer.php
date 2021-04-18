<?php

namespace Mjolnir\Traits;

use Mjolnir\App;
use Mjolnir\Container\Container;
use Psr\Container\ContainerInterface;

trait GetContainer
{
    /**
     * @return Container|ContainerInterface
     */
    public static function container()
    {
        $app = App::getInstance();
        return $app->getContainer();
    }
}
