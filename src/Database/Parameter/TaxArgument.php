<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameterable;

class TaxArgument
{
    use QueryParameterable;

    private ?string $taxonomy;
    private ?string $field;
    /**
     * @var int|array|string
     */
    private $terms;
    private bool $include_children;
    private ?string $operator;

    public function __construct(string $taxonomy = null, string $field = null, $terms = null, bool $include_children = true, string $operator = null)
    {
        $this->taxonomy = $taxonomy;
        $this->field = $field;
        $this->terms = $terms;
        $this->include_children = $include_children;
        $this->operator = $operator;
    }

    /**
     * @return string|null
     */
    public function getTaxonomy(): ?string
    {
        return $this->taxonomy;
    }

    /**
     * @return string|null
     */
    public function getField(): ?string
    {
        return $this->field;
    }

    /**
     * @return array|int|string
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * @return bool
     */
    public function isIncludeChildren(): bool
    {
        return $this->include_children;
    }

    /**
     * @return string|null
     */
    public function getOperator(): ?string
    {
        return $this->operator;
    }

    /**
     * @param string|null $taxonomy
     */
    public function setTaxonomy(?string $taxonomy): void
    {
        $this->taxonomy = $taxonomy;
    }

    /**
     * @param string|null $field
     */
    public function setField(?string $field): void
    {
        $this->field = $field;
    }

    /**
     * @param array|int|string $terms
     */
    public function setTerms($terms): void
    {
        $this->terms = $terms;
    }

    /**
     * @param bool $include_children
     */
    public function setIncludeChildren(bool $include_children): void
    {
        $this->include_children = $include_children;
    }

    /**
     * @param string|null $operator
     */
    public function setOperator(?string $operator): void
    {
        $this->operator = $operator;
    }
}
