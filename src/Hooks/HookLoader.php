<?php

namespace Mjolnir\Hooks;

use Mjolnir\Abstracts\AbstractApp;

class HookLoader
{
    const HOOKS = ['actions', 'filters'];
    /**
     * @var AbstractApp
     */
    private $container;

    /**
     * HookLoader constructor.
     * @param $container
     */
    public function __construct($container)
    {
        $this->setContainer($container);
        $this->requireFiles();
        $this->enableHooks();
    }

    /**
     * @param $container
     * @return static
     */
    public static function load($container): HookLoader
    {
        return new static($container);
    }

    /**
     * @param $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    /**
     *
     */
    private function requireFiles()
    {
        $path = $this->container->getPath();
        foreach (self::HOOKS as $hook) {
            $require = "{$path}/hooks/{$hook}.php";
            if (file_exists($require)) {
                require $require;
            }
        }
    }

    /**
     *
     */
    private function enableHooks()
    {
        $hooks = $this->container->get('hooks');
        $resolver = $this->container->get('resolver', true);

        foreach ($hooks as $hook) {
            $hookName = $hook->getName();
            $params = $hook->getArguments();
            $params['tag'] = $hook->getTag();
            $params['function'] = $resolver->resolve($params['function']);

            call_user_func_array($hookName, [$params['tag'], $params['function'], $params['priority'], $params['args']]);
        }
    }
}
