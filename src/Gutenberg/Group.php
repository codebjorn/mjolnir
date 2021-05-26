<?php

namespace Mjolnir\Gutenberg;

class Group
{
    /**
     * @var Block
     */
    private $block;
    /**
     * @var string
     */
    private $namespace;

    /**
     * Group constructor.
     * @param Block $block
     * @param string $namespace
     */
    public function __construct(Block $block, string $namespace)
    {
        $this->block = $block;
        $this->namespace = $namespace;
    }

    /**
     * @param string $name
     * @param string|null $path
     * @return $this
     */
    public function add(string $name, string $path = null): self
    {
        $this->block->add($this->namespace, $name, $path);

        return $this;
    }
}
