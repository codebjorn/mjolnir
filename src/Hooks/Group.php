<?php

namespace Mjolnir\Hooks;

use Mjolnir\Exceptions\HookGroupException;

class Group
{

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
     * @param $functionToAdd
     * @param int $priority
     * @param int $acceptedArgs
     * @return $this
     * @throws HookGroupException
     */
    public function add($functionToAdd, int $priority = 10, int $acceptedArgs = 1)
    {
        $this->call($functionToAdd, $priority, $acceptedArgs);
        return $this;
    }

    /**
     * @param $functionToAdd
     * @param int $priority
     * @param int $acceptedArgs
     * @throws HookGroupException
     */
    private function call($functionToAdd, int $priority, int $acceptedArgs)
    {
        if (!in_array($this->type, array_keys(self::TYPES_FUNCTIONS))) {
            throw new HookGroupException('Given type not exits');
        }
        $resolvedFunction = HookResolver::resolve($functionToAdd);

        call_user_func_array(self::TYPES_FUNCTIONS[$this->type], [$this->tag, $resolvedFunction, $priority, $acceptedArgs]);
    }
}
