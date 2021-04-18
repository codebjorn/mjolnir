<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class Password
{
    use QueryParameter;

    private ?bool $has_password;
    private ?string $post_password;

    public function __construct(bool $has_password = null, string $post_password = null)
    {
        $this->has_password = $has_password;
        $this->post_password = $post_password;
    }

    /**
     * @return bool|null
     */
    public function getHasPassword(): ?bool
    {
        return $this->has_password;
    }

    /**
     * @param bool|null $has_password
     */
    public function setHasPassword(?bool $has_password): void
    {
        $this->has_password = $has_password;
    }

    /**
     * @return string|null
     */
    public function getPostPassword(): ?string
    {
        return $this->post_password;
    }

    /**
     * @param string|null $post_password
     */
    public function setPostPassword(?string $post_password): void
    {
        $this->post_password = $post_password;
    }
}
