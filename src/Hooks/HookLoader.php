<?php

namespace Mjolnir\Hooks;

use Mjolnir\Container\ContainerResolver;
use Mjolnir\Contracts\AppInterface;
use Mjolnir\Contracts\LoaderInterface;
use Mjolnir\Exceptions\ContainerResolverException;

class HookLoader implements LoaderInterface
{
    private const HOOKS = ['actions', 'filters', 'shortcodes'];

    private AppInterface $app;

    /**
     * HookLoader constructor.
     * @param AppInterface $app
     * @throws ContainerResolverException
     */
    public function __construct(AppInterface $app)
    {
        $this->setApp($app);
        $this->addRepository();
        $this->requireFiles();
        $this->enableHooks();
    }

    /**
     * @param AppInterface $app
     * @return static
     * @throws ContainerResolverException
     */
    public static function load(AppInterface $app)
    {
        return new static($app);
    }

    /**
     * @param $app
     */
    public function setApp($app): void
    {
        $this->app = $app;
    }

    private function addRepository()
    {
        $this->app->getContainer()->add(HookRepository::class);
    }

    private function requireFiles()
    {
        $path = $this->app->getPath();

        foreach (self::HOOKS as $hook) {
            $require = "{$path}/hooks/{$hook}.php";
            if (file_exists($require)) {
                require $require;
            }
        }
    }

    /**
     * @throws ContainerResolverException
     */
    private function enableHooks()
    {
        $hooks = HookRepository::__instance()->get();

        foreach ($hooks as $hook) {
            $hookName = $hook->getName();
            $params = $hook->getArguments();
            $params['tag'] = $hook->getTag();
            $params['function'] = ContainerResolver::resolve($params['function']);

            call_user_func_array($hookName, [$params['tag'], $params['function'], $params['priority'], $params['args']]);
        }
    }

}
