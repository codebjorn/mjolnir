<?php

namespace Mjolnir\Hooks;

use Mjolnir\Abstracts\AbstractApp;

class Group
{
    /**
     * @var AbstractApp
     */
    private $app;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $tag;

    /**
     * Group constructor.
     * @param AbstractApp $app
     * @param string $type
     * @param string $tag
     */
    public function __construct(AbstractApp $app, string $type, string $tag)
    {
        $this->app = $app;
        $this->type = $type;
        $this->tag = $tag;
    }

    /**
     * @param $function
     * @param int $priority
     * @param int $args
     * @return $this
     */
    public function add($function, int $priority = 10, int $args = 1): Group
    {
        $hook = new Hook($this->type, $this->tag, [
            'function' => $function,
            'priority' => $priority,
            'args' => $args
        ]);

        $this->app->extend('hooks')
            ->addMethodCall('add', [$hook]);

        return $this;
    }
}
