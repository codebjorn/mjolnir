<?php

namespace Mjolnir\Contracts;

use Throwable;

interface ExceptionHandlerInterface
{
    public function report(Throwable $e);

    public function render(Throwable $e);
}
