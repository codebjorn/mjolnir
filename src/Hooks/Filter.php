<?php

namespace Mjolnir\Hooks;

use Mjolnir\Abstracts\AbstractHook;

class Filter extends AbstractHook
{
    protected static string $type = "add_filter";

    /**
     * @param $tag
     * @param $value
     */
    public static function apply($tag, $value)
    {
        apply_filters($tag, $value);
    }
}
