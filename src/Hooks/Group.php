<?php

namespace Mjolnir\Hooks;

use Mjolnir\Traits\GetContainer;

class Group
{
    use GetContainer;

    private const TYPES_FUNCTIONS = [
        'action' => 'add_action',
        'filter' => 'add_filter',
        'shortcode' => 'add_shortcode'
    ];

    private string $type;
    private string $tag;

    /**
     * Group constructor.
     * @param string $type
     * @param string $tag
     */
    public function __construct(string $type, string $tag)
    {
        $this->type = $type;
        $this->tag = $tag;
    }

    /**
     * @param $function
     * @param int $priority
     * @param int $args
     * @return $this
     */
    public function add($function, int $priority = 10, int $args = 1)
    {
        $hook = new Hook($this->type, $this->tag, [
            'function' => $function,
            'priority' => $priority,
            'args' => $args
        ]);

        static::container()->extend(HookRepository::class)
            ->addMethodCall('add', [$hook]);

        return $this;
    }
}
