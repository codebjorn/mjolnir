<?php

namespace Mjolnir\Contracts;

interface HookInterface
{
    public static function add(string $tag, $functionToAdd, int $priority = 10, int $acceptedArgs = 1);

    public static function group(string $tag);

    public function call(string $tag, $functionToAdd, int $priority = 10, int $acceptedArgs = 1);
}
