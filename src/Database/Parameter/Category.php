<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class Category
{
    use QueryParameter;

    /**
     * @var mixed|null
     */
    private $cat;
    /**
     * @var string|null
     */
    private $category_name;
    /**
     * @var array|null
     */
    private $category__and;
    /**
     * @var array|null
     */
    private $category__in;
    /**
     * @var array|null
     */
    private $category__not_in;

    /**
     * Category constructor.
     * @param null $cat
     * @param string|null $category_name
     * @param array|null $category__and
     * @param array|null $category__in
     * @param array|null $category__not_in
     */
    public function __construct($cat = null, string $category_name = null, array $category__and = null, array $category__in = null, array $category__not_in = null)
    {
        $this->cat = $cat;
        $this->category_name = $category_name;
        $this->category__and = $category__and;
        $this->category__in = $category__in;
        $this->category__not_in = $category__not_in;
    }

    /**
     * @return mixed|null
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * @return string|null
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * @return array|null
     */
    public function getCategoryAnd()
    {
        return $this->category__and;
    }

    /**
     * @return array|null
     */
    public function getCategoryIn()
    {
        return $this->category__in;
    }

    /**
     * @return array|null
     */
    public function getCategoryNotIn()
    {
        return $this->category__not_in;
    }

    /**
     * @param mixed|null $cat
     */
    public function setCat($cat)
    {
        $this->cat = $cat;
    }

    /**
     * @param string|null $category_name
     */
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

    /**
     * @param array|null $category__and
     */
    public function setCategoryAnd($category__and)
    {
        $this->category__and = $category__and;
    }

    /**
     * @param array|null $category__in
     */
    public function setCategoryIn($category__in)
    {
        $this->category__in = $category__in;
    }

    /**
     * @param array|null $category__not_in
     */
    public function setCategoryNotIn($category__not_in)
    {
        $this->category__not_in = $category__not_in;
    }
}
