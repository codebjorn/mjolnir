<?php

namespace Mjolnir\Abstracts;

use Mjolnir\Hooks\Group;
use Mjolnir\Hooks\Hook;

abstract class AbstractHook
{
    /**
     * @var string
     */
    protected $action = "add_action";
    /**
     * @var AbstractApp
     */
    protected $app;

    /**
     * AbstractHook constructor.
     * @param AbstractApp $app
     */
    public function __construct(AbstractApp $app)
    {
        $this->app = $app;
    }

    /**
     * @param string $tag
     * @return Group
     */
    public function group(string $tag): Group
    {
        return new Group($this->app, $this->action, $tag);
    }

    /**
     * @param string $tag
     * @param $function
     * @param int $priority
     * @param int $args
     */
    public function add(string $tag, $function, int $priority = 10, int $args = 1)
    {
        $hook = new Hook($this->action, $tag, [
            'function' => $function,
            'priority' => $priority,
            'args' => $args
        ]);

        $this->app->extend('hooks')
            ->addMethodCall('add', [$hook]);
    }
}
