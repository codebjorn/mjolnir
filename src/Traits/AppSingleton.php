<?php

namespace Mjolnir\Traits;

trait AppSingleton
{
    /**
     * @var $this
     */
    protected static $instance;

    /**
     * AppSingleton constructor.
     * @param null $basePath
     */
    public function __construct($basePath = null)
    {
        $this->setInstance();
        parent::__construct($basePath);
    }

    /**
     * @param null $basePath
     * @return static
     */
    public static function boot($basePath = null): self
    {
        return new static($basePath);
    }

    /**
     * @return mixed
     */
    public static function getInstance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     *
     */
    public function setInstance()
    {
        self::$instance = $this;
    }
}
