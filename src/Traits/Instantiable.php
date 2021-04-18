<?php

namespace Mjolnir\Traits;

use Mjolnir\App;

trait Instantiable
{
    /**
     * @return mixed|static
     */
    public static function __instance()
    {
        $app = App::getInstance();
        return $app->getContainer()->get(static::class);
    }
}
