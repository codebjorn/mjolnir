<?php

namespace Mjolnir\Hooks;

use Mjolnir\Abstracts\AbstractHook;

class Action extends AbstractHook
{
    protected $action = "add_action";

    /**
     * @param $tag
     * @param mixed ...$arg
     */
    public static function do($tag, ...$arg)
    {
        do_action($tag, $arg);
    }
}
