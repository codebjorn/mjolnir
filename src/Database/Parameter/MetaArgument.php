<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class MetaArgument
{
    use QueryParameter;

    /**
     * @var string|null
     */
    private $key;
    /**
     * @var null
     */
    private $value;
    /**
     * @var string|null
     */
    private $type;
    /**
     * @var string|null
     */
    private $compare;

    /**
     * MetaArgument constructor.
     * @param string|null $key
     * @param null $value
     * @param string|null $type
     * @param string|null $compare
     */
    public function __construct(string $key = null, $value = null, string $type = null, string $compare = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->type = $type;
        $this->compare = $compare;
    }

    /**
     * @return string|null
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string|null $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param null $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getCompare()
    {
        return $this->compare;
    }

    /**
     * @param string|null $compare
     */
    public function setCompare($compare)
    {
        $this->compare = $compare;
    }
}
