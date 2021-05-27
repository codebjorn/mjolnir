<?php

namespace Mjolnir\Routing;

class Api
{

    /**
     * @var string
     */
    private $namespace;
    /**
     * @var string
     */
    private $route;
    /**
     * @var array|null
     */
    private $args;
    /**
     * @var bool
     */
    private $override;

    /**
     * @param string $namespace
     * @param string $route
     * @param array|null $args
     * @param bool $override
     */
    public function __construct(string $namespace, string $route, array $args = null, bool $override = false)
    {
        $this->namespace = $namespace;
        $this->route = $route;
        $this->args = $args;
        $this->override = $override;
    }

    /**
     * @param string $namespace
     * @param string $route
     * @param array|null $args
     * @param bool $override
     * @return static
     */
    public static function make(string $namespace, string $route, array $args = null, bool $override = false): Api
    {
        return new static($namespace, $route, $args, $override);
    }

    /**
     * @return void
     */
    public function register()
    {
        register_rest_route($this->namespace, $this->route, $this->args, $this->override);
    }

    /**
     * @param $callback
     * @param $permissionCallback
     * @param array $args
     * @return $this
     */
    public function get($callback, $permissionCallback, array $args = []): Api
    {
        $this->args[] = [
            'methods' => "GET",
            'callback' => $callback,
            'permission_callback' => $permissionCallback,
            'args' => $args,
        ];

        return $this;
    }

    /**
     * @param $callback
     * @param $permissionCallback
     * @param array $args
     * @return $this
     */
    public function post($callback, $permissionCallback, array $args = []): Api
    {
        $this->args[] = [
            'methods' => "POST",
            'callback' => $callback,
            'permission_callback' => $permissionCallback,
            'args' => $args,
        ];

        return $this;
    }

    /**
     * @param $callback
     * @param $permissionCallback
     * @param array $args
     * @return $this
     */
    public function put($callback, $permissionCallback, array $args = []): Api
    {
        $this->args[] = [
            'methods' => "PUT",
            'callback' => $callback,
            'permission_callback' => $permissionCallback,
            'args' => $args,
        ];

        return $this;
    }

    /**
     * @param $callback
     * @param $permissionCallback
     * @param array $args
     * @return $this
     */
    public function path($callback, $permissionCallback, array $args = []): Api
    {
        $this->args[] = [
            'methods' => "PATH",
            'callback' => $callback,
            'permission_callback' => $permissionCallback,
            'args' => $args,
        ];

        return $this;
    }

    /**
     * @param $callback
     * @param $permissionCallback
     * @param array $args
     * @return $this
     */
    public function delete($callback, $permissionCallback, array $args = []): Api
    {
        $this->args[] = [
            'methods' => "DELETE",
            'callback' => $callback,
            'permission_callback' => $permissionCallback,
            'args' => $args,
        ];

        return $this;
    }

}
