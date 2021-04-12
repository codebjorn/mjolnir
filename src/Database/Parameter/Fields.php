<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameterable;

class Fields
{
    use QueryParameterable;

    private ?string $fields;

    public function __construct(string $fields = null)
    {
        $this->fields = $fields;
    }

    /**
     * @return string|null
     */
    public function getFields(): ?string
    {
        return $this->fields;
    }

    /**
     * @param string|null $fields
     */
    public function setFields(?string $fields): void
    {
        $this->fields = $fields;
    }
}
