<?php

namespace Mjolnir\Config;

use Exception;
use Mjolnir\Contracts\ArrayFactoryInterface;
use Mjolnir\Traits\Factoryable;

class ConfigFactory implements ArrayFactoryInterface
{
    use Factoryable;

    private string $path;
    private array $instances = [];

    /**
     * @param array|null $parameters
     * @return ConfigFactory
     * @throws Exception
     */
    public static function make(array $parameters = null)
    {
        $static = new static($parameters);
        return $static->buildInstances();
    }

    /**
     * @return array
     */
    public function getInstances()
    {
        return $this->instances;
    }

    /**
     * @param string $identifier
     * @return false|mixed
     */
    public function getInstance(string $identifier)
    {
        if (!$this->hasInstance($identifier)) {
            return $this->instances[$identifier];
        }

        return false;
    }

    /**
     * @param string $identifier
     * @param $value
     * @return $this
     */
    public function setInstance(string $identifier, $value)
    {
        if (!$this->hasInstance($identifier)) {
            $this->instances[$identifier] = new ConfigFactory($value);
        }

        return $this;
    }

    /**
     * @return $this
     * @throws Exception
     */
    public function buildInstances()
    {
        foreach ($this->dirFiles() as $file) {
            $configName = pathinfo($file, PATHINFO_FILENAME);
            $config = include "{$this->path}/{$file}";

            if ($config === null) {
                throw new Exception('Config file is empty');
            }

            if (!$this->hasInstance($configName)) {
                $this->instances[$configName] = new Config($config);
            }
        }

        return $this;
    }

    /**
     * @param string $identifier
     * @return bool
     */
    public function hasInstance(string $identifier)
    {
        return array_key_exists($identifier, $this->instances);
    }

    /**
     * @return array|false
     */
    private function dirFiles()
    {
        return array_diff(scandir($this->path), array('..', '.'));
    }
}
