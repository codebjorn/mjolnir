<?php

namespace Mjolnir\Config;

use Exception;
use Mjolnir\Support\Collection;
use Mjolnir\Traits\Factoryable;

class ConfigFactory
{
    use Factoryable;

    /**
     * @var string
     */
    private $path;
    /**
     * @var array
     */
    private $instances = [];

    /**
     * @param array|null $parameters
     * @return ConfigFactory
     * @throws Exception
     */
    public static function make(array $parameters = null): ConfigFactory
    {
        $static = new static($parameters);
        return $static->buildInstances();
    }

    /**
     * @return array
     */
    public function getInstances(): array
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
    public function setInstance(string $identifier, $value): ConfigFactory
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
    public function buildInstances(): ConfigFactory
    {
        foreach ($this->dirFiles() as $file) {
            $configName = pathinfo($file, PATHINFO_FILENAME);
            $config = include "{$this->path}/{$file}";

            if ($config === null) {
                throw new Exception('Config file is empty');
            }

            if (!$this->hasInstance($configName)) {
                $this->instances[$configName] = new Collection($config);
            }
        }

        return $this;
    }

    /**
     * @param string $identifier
     * @return bool
     */
    public function hasInstance(string $identifier): bool
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
