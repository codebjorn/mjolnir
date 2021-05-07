<?php

namespace Mjolnir\Hooks;

class Hook
{
    private $name;
    private $tag;
    private $arguments;

    /**
     * Hook constructor.
     * @param string|null $name
     * @param string|null $tag
     * @param array $arguments
     */
    public function __construct(string $name = null, string $tag = null, array $arguments = [])
    {
        $this->setName($name);
        $this->setTag($tag);
        $this->setArguments($arguments);
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @param string|null $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string|null $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @param array $arguments
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
    }

}
