<?php

namespace Mjolnir\Contracts;

use ArrayAccess;

interface ArrInterface extends ArrayAccess
{
    public static function make(array $elements = []);

    public function get(string $key);

    public function set(string $key, array $value);

    public function has(string $key);

    public function remove($element);

    public function isEmpty();
}
