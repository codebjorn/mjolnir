<?php

namespace Mjolnir\Contracts;

use ArrayAccess;

interface ArrInterface extends ArrayAccess
{
    public function has($key);

    public function toArray();
}
