<?php

namespace Mjolnir\Utils;

class Post
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $author;
    /**
     * @var string
     */
    private $date;
    /**
     * @var string
     */
    private $dateGMT;
    /**
     * @var string
     */
    private $content;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $excerpt;
    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $commentStatus;
    /**
     * @var string
     */
    private $pingStatus;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $slug;
    /**
     * @var string
     */
    private $toPing;
    /**
     * @var string
     */
    private $pinged;
    /**
     * @var string
     */
    private $modified;
    /**
     * @var string
     */
    private $modifiedGMT;
    /**
     * @var string
     */
    private $contentFiltered;
    /**
     * @var int
     */
    private $parent;
    /**
     * @var int
     */
    private $order;
    /**
     * @var string
     */
    private $postType;
    /**
     * @var string
     */
    private $mimeType;
    /**
     * @var int
     */
    private $commentCount;
    /**
     * @var string
     */
    public $filter;

    /**
     * Post constructor.
     * @param int|null $id
     */
    public function __construct(int $id = null)
    {
        $post = get_post($id);
        $this->id = $post->ID;
        $this->author = $post->post_author;
        $this->date = $post->post_date;
        $this->dateGMT = $post->post_date_gmt;
        $this->content = $post->post_content;
        $this->title = $post->post_title;
        $this->excerpt = $post->post_excerpt;
        $this->status = $post->post_status;
        $this->commentStatus = $post->comment_status;
        $this->pingStatus = $post->ping_status;
        $this->password = $post->post_password;
        $this->slug = $post->post_name;
        $this->toPing = $post->to_ping;
        $this->pinged = $post->pinged;
        $this->modified = $post->post_modified;
        $this->modifiedGMT = $post->post_modified_gmt;
        $this->contentFiltered = $post->post_content_filtered;
        $this->parent = $post->post_parent;
        $this->order = $post->menu_order;
        $this->postType = $post->post_type;
        $this->mimeType = $post->post_mime_type;
        $this->commentCount = $post->comment_count;
        $this->filter = $post->filter;
    }

    /**
     * @param int|null $id
     * @return Post
     */
    public static function get(int $id = null): Post
    {
        return new static($id);
    }

    /**
     * @return Post
     */
    public static function current(): Post
    {
        return new static(get_the_ID());
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getDateGMT(): string
    {
        return $this->dateGMT;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getExcerpt(): string
    {
        return $this->excerpt;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getCommentStatus(): string
    {
        return $this->commentStatus;
    }

    /**
     * @return string
     */
    public function getPingStatus(): string
    {
        return $this->pingStatus;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getToPing(): string
    {
        return $this->toPing;
    }

    /**
     * @return string
     */
    public function getPinged(): string
    {
        return $this->pinged;
    }

    /**
     * @return string
     */
    public function getModified(): string
    {
        return $this->modified;
    }

    /**
     * @return string
     */
    public function getModifiedGMT(): string
    {
        return $this->modifiedGMT;
    }

    /**
     * @return string
     */
    public function getContentFiltered(): string
    {
        return $this->contentFiltered;
    }

    /**
     * @return int
     */
    public function getParent(): int
    {
        return $this->parent;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getPostType(): string
    {
        return $this->postType;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @return int
     */
    public function getCommentCount(): int
    {
        return $this->commentCount;
    }

    /**
     * @return string
     */
    public function getFilter(): string
    {
        return $this->filter;
    }
}
