<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameterable;

class MetaArgument
{
    use QueryParameterable;

    private ?string $key;
    /**
     * @var null
     */
    private $value;
    private ?string $type;
    private ?string $compare;

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
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @param string|null $key
     */
    public function setKey(?string $key): void
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
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getCompare(): ?string
    {
        return $this->compare;
    }

    /**
     * @param string|null $compare
     */
    public function setCompare(?string $compare): void
    {
        $this->compare = $compare;
    }
}
