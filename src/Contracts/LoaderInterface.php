<?php

namespace Mjolnir\Contracts;

interface LoaderInterface
{
    public function __construct(AppInterface $app);

    public static function load(AppInterface $app);

    public function setApp($app);
}
