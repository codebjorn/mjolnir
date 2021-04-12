<?php

namespace Mjolnir\Abstracts;

use League\Container\ServiceProvider\AbstractServiceProvider as BaseAbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

abstract class AbstractServiceProvider extends BaseAbstractServiceProvider implements BootableServiceProviderInterface
{
}
