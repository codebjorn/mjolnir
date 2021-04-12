<?php

namespace Mjolnir\Contracts;

use Throwable;

interface ExceptionLoggerInterface
{
    public function createLogFile();

    public function writeLog($args = []);

    public function fatal($message, array $context = []);
}
