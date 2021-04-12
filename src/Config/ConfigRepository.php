<?php

namespace Mjolnir\Config;

use \InvalidArgumentException;
use Mjolnir\Abstracts\AbstractArr;

class ConfigRepository extends AbstractArr
{
    /**
     * @param $name
     * @param $arguments
     * @return false|Config
     * @throws InvalidArgumentException
     */
    public function __call($name, $arguments)
    {
        if (substr($name, 0, 3) === 'get') {
            $configName = strtolower(str_replace('get', '', $name));

            if ($this->has($configName)) {
                return $this->get($configName);
            }

            throw new InvalidArgumentException("{$configName} not found in Repository");
        }

        throw new InvalidArgumentException("Method {$name} not found in Repository");
    }
}
