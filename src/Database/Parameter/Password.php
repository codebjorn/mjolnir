<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class Password
{
    use QueryParameter;

    /**
     * @var bool|null
     */
    private $has_password;
    /**
     * @var string|null
     */
    private $post_password;

    /**
     * Password constructor.
     * @param bool|null $has_password
     * @param string|null $post_password
     */
    public function __construct(bool $has_password = null, string $post_password = null)
    {
        $this->has_password = $has_password;
        $this->post_password = $post_password;
    }

    /**
     * @return bool|null
     */
    public function getHasPassword()
    {
        return $this->has_password;
    }

    /**
     * @param bool|null $has_password
     */
    public function setHasPassword($has_password)
    {
        $this->has_password = $has_password;
    }

    /**
     * @return string|null
     */
    public function getPostPassword()
    {
        return $this->post_password;
    }

    /**
     * @param string|null $post_password
     */
    public function setPostPassword($post_password)
    {
        $this->post_password = $post_password;
    }
}
