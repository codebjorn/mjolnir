<?php

namespace Mjolnir\Routing;

class Api
{

    private string $namespace;
    private string $route;
    private ?array $args;
    private bool $override;

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
    public static function make(string $namespace, string $route, array $args = null, bool $override = false)
    {
        return new static($namespace, $route, $args, $override);
    }

    /**
     * @return mixed
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
    public function get($callback, $permissionCallback, array $args = [])
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
    public function post($callback, $permissionCallback, array $args = [])
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
    public function put($callback, $permissionCallback, array $args = [])
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
    public function path($callback, $permissionCallback, array $args = [])
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
    public function delete($callback, $permissionCallback, array $args = [])
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
