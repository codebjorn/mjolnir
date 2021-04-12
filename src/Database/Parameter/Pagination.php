<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameterable;

class Pagination
{
    use QueryParameterable;

    private ?int $posts_per_page;
    private ?bool $nopaging;
    private ?int $paged;
    private ?int $posts_per_archive_page;
    private ?int $offset;
    private ?int $page;
    private ?bool $ignore_sticky_posts;

    public function __construct(int $posts_per_page = null, bool $nopaging = null, int $paged = null, int $posts_per_archive_page = null, int $offset = null, int $page = null, bool $ignore_sticky_posts = null)
    {
        $this->posts_per_page = $posts_per_page;
        $this->nopaging = $nopaging;
        $this->paged = $paged;
        $this->posts_per_archive_page = $posts_per_archive_page;
        $this->offset = $offset;
        $this->page = $page;
        $this->ignore_sticky_posts = $ignore_sticky_posts;
    }

    /**
     * @return int|null
     */
    public function getPostsPerPage(): ?int
    {
        return $this->posts_per_page;
    }

    /**
     * @param int|null $posts_per_page
     */
    public function setPostsPerPage(?int $posts_per_page): void
    {
        $this->posts_per_page = $posts_per_page;
    }

    /**
     * @return bool|null
     */
    public function getNopaging(): ?bool
    {
        return $this->nopaging;
    }

    /**
     * @param bool|null $nopaging
     */
    public function setNopaging(?bool $nopaging): void
    {
        $this->nopaging = $nopaging;
    }

    /**
     * @return int|null
     */
    public function getPaged(): ?int
    {
        return $this->paged;
    }

    /**
     * @param int|null $paged
     */
    public function setPaged(?int $paged): void
    {
        $this->paged = $paged;
    }

    /**
     * @return int|null
     */
    public function getPostsPerArchivePage(): ?int
    {
        return $this->posts_per_archive_page;
    }

    /**
     * @param int|null $posts_per_archive_page
     */
    public function setPostsPerArchivePage(?int $posts_per_archive_page): void
    {
        $this->posts_per_archive_page = $posts_per_archive_page;
    }

    /**
     * @return int|null
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * @param int|null $offset
     */
    public function setOffset(?int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * @return int|null
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * @param int|null $page
     */
    public function setPage(?int $page): void
    {
        $this->page = $page;
    }

    /**
     * @return bool|null
     */
    public function getIgnoreStickyPosts(): ?bool
    {
        return $this->ignore_sticky_posts;
    }

    /**
     * @param bool|null $ignore_sticky_posts
     */
    public function setIgnoreStickyPosts(?bool $ignore_sticky_posts): void
    {
        $this->ignore_sticky_posts = $ignore_sticky_posts;
    }
}
