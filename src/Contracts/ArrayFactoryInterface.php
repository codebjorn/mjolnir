<?php

namespace Mjolnir\Contracts;

interface ArrayFactoryInterface
{
    public function __construct(array $parameters = null);

    public static function make(array $parameters = null);

    public function getInstances();

    public function getInstance(string $identifier);

    public function setInstance(string $identifier, $value);

    public function buildInstances();

    public function hasInstance(string $identifier);
}
