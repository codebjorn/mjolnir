<?php

namespace Mjolnir\Hooks;

class Group
{
    private $containerClass;
    private $type;
    private $tag;

    /**
     * Group constructor.
     * @param string $containerClass
     * @param string $type
     * @param string $tag
     */
    public function __construct(string $containerClass, string $type, string $tag)
    {
        $this->containerClass = $containerClass;
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

        $container = call_user_func([$this->containerClass, 'getInstance']);
        $container->extend('hooks')
            ->addMethodCall('add', [$hook]);

        return $this;
    }
}
