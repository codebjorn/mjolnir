<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameterable;

class PostType
{
    use QueryParameterable;

    private $post_type;

    public function __construct($post_type = null)
    {
        $this->post_type = $post_type;
    }
}
