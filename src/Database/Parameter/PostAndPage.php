<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class PostAndPage
{
    use QueryParameter;

    private ?int $p;
    private ?string $name;
    private ?string $title;
    private ?int $page_id;
    private ?string $pagename;
    private ?array $post_name__in;
    private ?array $post_parent;
    private ?array $post_parent__in;
    private ?array $post_parent__not_in;
    private ?array $post__in;
    private ?array $post__not_in;

    public function __construct(int $p = null, string $name = null, string $title = null, int $page_id = null, string $pagename = null, array $post_name__in = null, array $post_parent = null, array $post_parent__in = null, array $post_parent__not_in = null, array $post__in = null, array $post__not_in = null)
    {
        $this->p = $p;
        $this->name = $name;
        $this->title = $title;
        $this->page_id = $page_id;
        $this->pagename = $pagename;
        $this->post_name__in = $post_name__in;
        $this->post_parent = $post_parent;
        $this->post_parent__in = $post_parent__in;
        $this->post_parent__not_in = $post_parent__not_in;
        $this->post__in = $post__in;
        $this->post__not_in = $post__not_in;
    }

    /**
     * @return int|null
     */
    public function getP(): ?int
    {
        return $this->p;
    }

    /**
     * @param int|null $p
     */
    public function setP(?int $p): void
    {
        $this->p = $p;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return int|null
     */
    public function getPageId(): ?int
    {
        return $this->page_id;
    }

    /**
     * @param int|null $page_id
     */
    public function setPageId(?int $page_id): void
    {
        $this->page_id = $page_id;
    }

    /**
     * @return string|null
     */
    public function getPagename(): ?string
    {
        return $this->pagename;
    }

    /**
     * @param string|null $pagename
     */
    public function setPagename(?string $pagename): void
    {
        $this->pagename = $pagename;
    }

    /**
     * @return array|null
     */
    public function getPostNameIn(): ?array
    {
        return $this->post_name__in;
    }

    /**
     * @param array|null $post_name__in
     */
    public function setPostNameIn(?array $post_name__in): void
    {
        $this->post_name__in = $post_name__in;
    }

    /**
     * @return array|null
     */
    public function getPostParent(): ?array
    {
        return $this->post_parent;
    }

    /**
     * @param array|null $post_parent
     */
    public function setPostParent(?array $post_parent): void
    {
        $this->post_parent = $post_parent;
    }

    /**
     * @return array|null
     */
    public function getPostParentIn(): ?array
    {
        return $this->post_parent__in;
    }

    /**
     * @param array|null $post_parent__in
     */
    public function setPostParentIn(?array $post_parent__in): void
    {
        $this->post_parent__in = $post_parent__in;
    }

    /**
     * @return array|null
     */
    public function getPostParentNotIn(): ?array
    {
        return $this->post_parent__not_in;
    }

    /**
     * @param array|null $post_parent__not_in
     */
    public function setPostParentNotIn(?array $post_parent__not_in): void
    {
        $this->post_parent__not_in = $post_parent__not_in;
    }

    /**
     * @return array|null
     */
    public function getPostIn(): ?array
    {
        return $this->post__in;
    }

    /**
     * @param array|null $post__in
     */
    public function setPostIn(?array $post__in): void
    {
        $this->post__in = $post__in;
    }

    /**
     * @return array|null
     */
    public function getPostNotIn(): ?array
    {
        return $this->post__not_in;
    }

    /**
     * @param array|null $post__not_in
     */
    public function setPostNotIn(?array $post__not_in): void
    {
        $this->post__not_in = $post__not_in;
    }
}
