<?php

namespace Mjolnir\Hooks;

use Mjolnir\Abstracts\AbstractHook;

class Filter extends AbstractHook
{
    protected $action = "add_filter";

    public static function apply($tag, $value)
    {
        apply_filters($tag, $value);
    }
}
