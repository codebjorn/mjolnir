<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameterable;

class Tag
{
    use QueryParameterable;

    private ?string $tag;
    private ?int $tag_id;
    private ?array $tag__and;
    private ?array $tag__in;
    private ?array $tag__not_in;
    private ?array $tag_slug__and;
    private ?array $tag_slug__in;

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
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @return int|null
     */
    public function getTagId(): ?int
    {
        return $this->tag_id;
    }

    /**
     * @return array|null
     */
    public function getTagAnd(): ?array
    {
        return $this->tag__and;
    }

    /**
     * @return array|null
     */
    public function getTagIn(): ?array
    {
        return $this->tag__in;
    }

    /**
     * @return array|null
     */
    public function getTagNotIn(): ?array
    {
        return $this->tag__not_in;
    }

    /**
     * @return array|null
     */
    public function getTagSlugAnd(): ?array
    {
        return $this->tag_slug__and;
    }

    /**
     * @return array|null
     */
    public function getTagSlugIn(): ?array
    {
        return $this->tag_slug__in;
    }

    /**
     * @param string|null $tag
     */
    public function setTag(?string $tag): void
    {
        $this->tag = $tag;
    }

    /**
     * @param int|null $tag_id
     */
    public function setTagId(?int $tag_id): void
    {
        $this->tag_id = $tag_id;
    }

    /**
     * @param array|null $tag__and
     */
    public function setTagAnd(?array $tag__and): void
    {
        $this->tag__and = $tag__and;
    }

    /**
     * @param array|null $tag__in
     */
    public function setTagIn(?array $tag__in): void
    {
        $this->tag__in = $tag__in;
    }

    /**
     * @param array|null $tag__not_in
     */
    public function setTagNotIn(?array $tag__not_in): void
    {
        $this->tag__not_in = $tag__not_in;
    }

    /**
     * @param array|null $tag_slug__and
     */
    public function setTagSlugAnd(?array $tag_slug__and): void
    {
        $this->tag_slug__and = $tag_slug__and;
    }

    /**
     * @param array|null $tag_slug__in
     */
    public function setTagSlugIn(?array $tag_slug__in): void
    {
        $this->tag_slug__in = $tag_slug__in;
    }
}
