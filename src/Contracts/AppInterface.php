<?php

namespace Mjolnir\Contracts;

interface AppInterface
{
    public static function boot(string $path = '');

    public static function instance();

    public function container();

    public function containerFactory();
}
