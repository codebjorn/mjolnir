<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class TaxArgument
{
    use QueryParameter;

    /**
     * @var string|null
     */
    private $taxonomy;
    /**
     * @var string|null
     */
    private $field;
    /**
     * @var int|array|string
     */
    private $terms;
    /**
     * @var
     */
    private $include_children;
    /**
     * @var string|null
     */
    private $operator;

    /**
     * TaxArgument constructor.
     * @param string|null $taxonomy
     * @param string|null $field
     * @param null $terms
     * @param $include_children
     * @param string|null $operator
     */
    public function __construct(string $taxonomy = null, string $field = null, $terms = null, $include_children = true, string $operator = null)
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
    public function getTaxonomy()
    {
        return $this->taxonomy;
    }

    /**
     * @return string|null
     */
    public function getField()
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
     * @return
     */
    public function isIncludeChildren()
    {
        return $this->include_children;
    }

    /**
     * @return string|null
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param string|null $taxonomy
     */
    public function setTaxonomy($taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }

    /**
     * @param string|null $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @param array|int|string $terms
     */
    public function setTerms($terms)
    {
        $this->terms = $terms;
    }

    /**
     * @param $include_children
     */
    public function setIncludeChildren($include_children)
    {
        $this->include_children = $include_children;
    }

    /**
     * @param string|null $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }
}
