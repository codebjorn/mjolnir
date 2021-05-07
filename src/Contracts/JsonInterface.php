<?php

namespace Mjolnir\Contracts;

use ArrayAccess;

interface JsonInterface extends ArrayAccess
{
    public function toJson();
}
