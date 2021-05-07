<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class PostAndPage
{
    use QueryParameter;

    /**
     * @var int|null
     */
    private $p;
    /**
     * @var string|null
     */
    private $name;
    /**
     * @var string|null
     */
    private $title;
    /**
     * @var int|null
     */
    private $page_id;
    /**
     * @var string|null
     */
    private $pagename;
    /**
     * @var array|null
     */
    private $post_name__in;
    /**
     * @var array|null
     */
    private $post_parent;
    /**
     * @var array|null
     */
    private $post_parent__in;
    /**
     * @var array|null
     */
    private $post_parent__not_in;
    /**
     * @var array|null
     */
    private $post__in;
    /**
     * @var array|null
     */
    private $post__not_in;

    /**
     * PostAndPage constructor.
     * @param int|null $p
     * @param string|null $name
     * @param string|null $title
     * @param int|null $page_id
     * @param string|null $pagename
     * @param array|null $post_name__in
     * @param array|null $post_parent
     * @param array|null $post_parent__in
     * @param array|null $post_parent__not_in
     * @param array|null $post__in
     * @param array|null $post__not_in
     */
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
    public function getP()
    {
        return $this->p;
    }

    /**
     * @param int|null $p
     */
    public function setP($p)
    {
        $this->p = $p;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return int|null
     */
    public function getPageId()
    {
        return $this->page_id;
    }

    /**
     * @param int|null $page_id
     */
    public function setPageId($page_id)
    {
        $this->page_id = $page_id;
    }

    /**
     * @return string|null
     */
    public function getPagename()
    {
        return $this->pagename;
    }

    /**
     * @param string|null $pagename
     */
    public function setPagename($pagename)
    {
        $this->pagename = $pagename;
    }

    /**
     * @return array|null
     */
    public function getPostNameIn()
    {
        return $this->post_name__in;
    }

    /**
     * @param array|null $post_name__in
     */
    public function setPostNameIn($post_name__in)
    {
        $this->post_name__in = $post_name__in;
    }

    /**
     * @return array|null
     */
    public function getPostParent()
    {
        return $this->post_parent;
    }

    /**
     * @param array|null $post_parent
     */
    public function setPostParent($post_parent)
    {
        $this->post_parent = $post_parent;
    }

    /**
     * @return array|null
     */
    public function getPostParentIn()
    {
        return $this->post_parent__in;
    }

    /**
     * @param array|null $post_parent__in
     */
    public function setPostParentIn($post_parent__in)
    {
        $this->post_parent__in = $post_parent__in;
    }

    /**
     * @return array|null
     */
    public function getPostParentNotIn()
    {
        return $this->post_parent__not_in;
    }

    /**
     * @param array|null $post_parent__not_in
     */
    public function setPostParentNotIn($post_parent__not_in)
    {
        $this->post_parent__not_in = $post_parent__not_in;
    }

    /**
     * @return array|null
     */
    public function getPostIn()
    {
        return $this->post__in;
    }

    /**
     * @param array|null $post__in
     */
    public function setPostIn($post__in)
    {
        $this->post__in = $post__in;
    }

    /**
     * @return array|null
     */
    public function getPostNotIn()
    {
        return $this->post__not_in;
    }

    /**
     * @param array|null $post__not_in
     */
    public function setPostNotIn($post__not_in)
    {
        $this->post__not_in = $post__not_in;
    }
}
