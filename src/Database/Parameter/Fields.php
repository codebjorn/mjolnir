<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class Fields
{
    use QueryParameter;

    /**
     * @var string|null
     */
    private $fields;

    /**
     * Fields constructor.
     * @param string|null $fields
     */
    public function __construct(string $fields = null)
    {
        $this->fields = $fields;
    }

    /**
     * @return string|null
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param string|null $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }
}
