<?php

namespace Mjolnir\Contracts;

interface FactoryInterface
{
    public function __construct(array $parameters = null);

    public static function make(array $parameters = null);

    public function getInstance();

    public function setInstance(object $instance);
}
