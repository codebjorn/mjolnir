<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class PostStatus
{
    use QueryParameter;

    /**
     * @var null
     */
    private $post_status;

    public function __construct($post_status = null)
    {
        $this->post_status = $post_status;
    }

    /**
     * @return null
     */
    public function getPostStatus()
    {
        return $this->post_status;
    }

    /**
     * @param null $post_status
     */
    public function setPostStatus($post_status): void
    {
        $this->post_status = $post_status;
    }
}
