<?php

namespace Mjolnir\Hooks;

use Mjolnir\App;

class HookLoader
{
    private const HOOKS = ['actions', 'filters', 'shortcodes'];
    private string $path;

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @param string $path
     */
    public static function make(string $path)
    {
        (new static($path))->load();
    }

    /**
     * @return mixed
     */
    private function load()
    {
        foreach (self::HOOKS as $hook) {
            $require = "{$this->path}/hooks/{$hook}.php";
            if (file_exists($require)) {
                require $require;
            }
        }
    }
}
