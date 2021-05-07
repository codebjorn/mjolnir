<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class Tag
{
    use QueryParameter;

    /**
     * @var string|null
     */
    private $tag;
    /**
     * @var int|null
     */
    private $tag_id;
    /**
     * @var array|null
     */
    private $tag__and;
    /**
     * @var array|null
     */
    private $tag__in;
    /**
     * @var array|null
     */
    private $tag__not_in;
    /**
     * @var array|null
     */
    private $tag_slug__and;
    /**
     * @var array|null
     */
    private $tag_slug__in;

    /**
     * Tag constructor.
     * @param string|null $tag
     * @param int|null $tag_id
     * @param array|null $tag__and
     * @param array|null $tag__in
     * @param array|null $tag__not_in
     * @param array|null $tag_slug__and
     * @param array|null $tag_slug__in
     */
    public function __construct(string $tag = null, int $tag_id = null, array $tag__and = null, array $tag__in = null, array $tag__not_in = null, array $tag_slug__and = null, array $tag_slug__in = null)
    {
        $this->tag = $tag;
        $this->tag_id = $tag_id;
        $this->tag__and = $tag__and;
        $this->tag__in = $tag__in;
        $this->tag__not_in = $tag__not_in;
        $this->tag_slug__and = $tag_slug__and;
        $this->tag_slug__in = $tag_slug__in;
    }

    /**
     * @return string|null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @return int|null
     */
    public function getTagId()
    {
        return $this->tag_id;
    }

    /**
     * @return array|null
     */
    public function getTagAnd()
    {
        return $this->tag__and;
    }

    /**
     * @return array|null
     */
    public function getTagIn()
    {
        return $this->tag__in;
    }

    /**
     * @return array|null
     */
    public function getTagNotIn()
    {
        return $this->tag__not_in;
    }

    /**
     * @return array|null
     */
    public function getTagSlugAnd()
    {
        return $this->tag_slug__and;
    }

    /**
     * @return array|null
     */
    public function getTagSlugIn()
    {
        return $this->tag_slug__in;
    }

    /**
     * @param string|null $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @param int|null $tag_id
     */
    public function setTagId($tag_id)
    {
        $this->tag_id = $tag_id;
    }

    /**
     * @param array|null $tag__and
     */
    public function setTagAnd($tag__and)
    {
        $this->tag__and = $tag__and;
    }

    /**
     * @param array|null $tag__in
     */
    public function setTagIn($tag__in)
    {
        $this->tag__in = $tag__in;
    }

    /**
     * @param array|null $tag__not_in
     */
    public function setTagNotIn($tag__not_in)
    {
        $this->tag__not_in = $tag__not_in;
    }

    /**
     * @param array|null $tag_slug__and
     */
    public function setTagSlugAnd($tag_slug__and)
    {
        $this->tag_slug__and = $tag_slug__and;
    }

    /**
     * @param array|null $tag_slug__in
     */
    public function setTagSlugIn($tag_slug__in)
    {
        $this->tag_slug__in = $tag_slug__in;
    }
}
