<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class Comment
{
    use QueryParameter;

    /**
     * @var null
     */
    private $comment_count;

    public function __construct($comment_count = null)
    {
        $this->comment_count = $comment_count;
    }

    /**
     * @return null
     */
    public function getCommentCount()
    {
        return $this->comment_count;
    }

    /**
     * @param null $comment_count
     */
    public function setCommentCount($comment_count)
    {
        $this->comment_count = $comment_count;
    }
}
