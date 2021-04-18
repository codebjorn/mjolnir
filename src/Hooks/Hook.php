<?php

namespace Mjolnir\Hooks;

class Hook
{
    private ?string $name;
    private ?string $tag;
    private array $arguments;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getTag(): ?string
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
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string|null $tag
     */
    public function setTag(?string $tag): void
    {
        $this->tag = $tag;
    }

    /**
     * @param array $arguments
     */
    public function setArguments(array $arguments): void
    {
        $this->arguments = $arguments;
    }

}
