<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class PostType
{
    use QueryParameter;

    /**
     * @var string|null
     */
    private $post_type;

    /**
     * PostType constructor.
     * @param string|null $post_type
     */
    public function __construct(string $post_type = null)
    {
        $this->post_type = $post_type;
    }
}
