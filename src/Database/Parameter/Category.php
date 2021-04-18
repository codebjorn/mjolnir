<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class Category
{
    use QueryParameter;

    private $cat;
    private ?string $category_name;
    private ?array $category__and;
    private ?array $category__in;
    private ?array $category__not_in;

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
    public function getCategoryName(): ?string
    {
        return $this->category_name;
    }

    /**
     * @return array|null
     */
    public function getCategoryAnd(): ?array
    {
        return $this->category__and;
    }

    /**
     * @return array|null
     */
    public function getCategoryIn(): ?array
    {
        return $this->category__in;
    }

    /**
     * @return array|null
     */
    public function getCategoryNotIn(): ?array
    {
        return $this->category__not_in;
    }

    /**
     * @param mixed|null $cat
     */
    public function setCat($cat): void
    {
        $this->cat = $cat;
    }

    /**
     * @param string|null $category_name
     */
    public function setCategoryName(?string $category_name): void
    {
        $this->category_name = $category_name;
    }

    /**
     * @param array|null $category__and
     */
    public function setCategoryAnd(?array $category__and): void
    {
        $this->category__and = $category__and;
    }

    /**
     * @param array|null $category__in
     */
    public function setCategoryIn(?array $category__in): void
    {
        $this->category__in = $category__in;
    }

    /**
     * @param array|null $category__not_in
     */
    public function setCategoryNotIn(?array $category__not_in): void
    {
        $this->category__not_in = $category__not_in;
    }
}
