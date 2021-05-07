<?php

namespace Mjolnir\Abstracts;

abstract class AbstractCustomContent
{
    protected $name;
    protected $arguments;

    /**
     * @param string $name
     * @param array $arguments
     * @return static
     */
    public static function make(string $name, array $arguments = [])
    {
        return new static($name, $arguments);
    }

    /**
     * @param string $name
     * @param array $arguments
     */
    public function __construct(string $name, array $arguments = [])
    {
        $this->name = $name;
        $this->arguments = $arguments ?: ['public' => true];
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @return mixed
     */
    abstract public function register();

    /**
     * @param array $labels
     * @return static
     */
    public function labels(array $labels)
    {
        $this->setArgument('labels', $labels);
        return $this;
    }

    /**
     * @param string $description
     * @return static
     */
    public function description(string $description)
    {
        $this->setArgument('description', $description);
        return $this;
    }

    /**
     * @param bool $hierarchical
     * @return static
     */
    public function hierarchical(bool $hierarchical = true)
    {
        $this->setArgument('hierarchical', $hierarchical);
        return $this;
    }

    /**
     * @param bool $value
     * @return static
     */
    public function public($value = true)
    {
        $this->setArgument('public', $value);
        return $this;
    }

    /**
     * @param bool $value
     * @return static
     */
    public function publicyQueryable(bool $value = true)
    {
        $this->setArgument('publicly_queryable', $value);
        return $this;
    }

    /**
     * @param $rewrite
     * @return static
     */
    public function rewrite($rewrite)
    {
        $this->setArgument('rewrite', $rewrite);
        return $this;
    }

    /**
     * @param bool $show
     * @return static
     */
    public function showUi(bool $show = true)
    {
        $this->setArgument('show_ui', $show);
        return $this;
    }

    /**
     * @param bool $show
     * @return static
     */
    public function showInMenu($show = true)
    {
        $this->setArgument('show_in_menu', $show);
        return $this;
    }

    /**
     * @param bool $show
     * @return static
     */
    public function showInNavMenus($show = true)
    {
        $this->setArgument('show_in_nav_menus', $show);
        return $this;
    }

    /**
     * @param bool $show
     * @return static
     */
    public function showInRest(bool $show = true)
    {
        $this->setArgument('show_in_rest', $show);
        return $this;
    }

    /**
     * @param string $base
     * @return static
     */
    public function restBase(string $base)
    {
        $this->setArgument('rest_base', $base);
        return $this;
    }

    /**
     * @param string $base
     * @return static
     */
    public function restControllerClass(string $base)
    {
        $this->setArgument('rest_controller_class', $base);
        return $this;
    }

    /**
     * @param string $key
     * @param $value
     */
    protected function setArgument(string $key, $value)
    {
        $this->arguments[$key] = $value;
    }
}
