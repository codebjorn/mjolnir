<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class PostType
{
    use QueryParameter;

    private $post_type;

    public function __construct($post_type = null)
    {
        $this->post_type = $post_type;
    }
}
