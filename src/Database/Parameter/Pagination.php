<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class Pagination
{
    use QueryParameter;

    /**
     * @var int|null
     */
    private $posts_per_page;
    /**
     * @var bool|null
     */
    private $nopaging;
    /**
     * @var int|null
     */
    private $paged;
    /**
     * @var int|null
     */
    private $posts_per_archive_page;
    /**
     * @var int|null
     */
    private $offset;
    /**
     * @var int|null
     */
    private $page;
    /**
     * @var bool|null
     */
    private $ignore_sticky_posts;

    /**
     * Pagination constructor.
     * @param int|null $posts_per_page
     * @param bool|null $nopaging
     * @param int|null $paged
     * @param int|null $posts_per_archive_page
     * @param int|null $offset
     * @param int|null $page
     * @param bool|null $ignore_sticky_posts
     */
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
    public function getPostsPerPage()
    {
        return $this->posts_per_page;
    }

    /**
     * @param int|null $posts_per_page
     */
    public function setPostsPerPage($posts_per_page)
    {
        $this->posts_per_page = $posts_per_page;
    }

    /**
     * @return bool|null
     */
    public function getNopaging()
    {
        return $this->nopaging;
    }

    /**
     * @param bool|null $nopaging
     */
    public function setNopaging($nopaging)
    {
        $this->nopaging = $nopaging;
    }

    /**
     * @return int|null
     */
    public function getPaged()
    {
        return $this->paged;
    }

    /**
     * @param int|null $paged
     */
    public function setPaged($paged)
    {
        $this->paged = $paged;
    }

    /**
     * @return int|null
     */
    public function getPostsPerArchivePage()
    {
        return $this->posts_per_archive_page;
    }

    /**
     * @param int|null $posts_per_archive_page
     */
    public function setPostsPerArchivePage($posts_per_archive_page)
    {
        $this->posts_per_archive_page = $posts_per_archive_page;
    }

    /**
     * @return int|null
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int|null $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @return int|null
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int|null $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return bool|null
     */
    public function getIgnoreStickyPosts()
    {
        return $this->ignore_sticky_posts;
    }

    /**
     * @param bool|null $ignore_sticky_posts
     */
    public function setIgnoreStickyPosts($ignore_sticky_posts)
    {
        $this->ignore_sticky_posts = $ignore_sticky_posts;
    }
}
