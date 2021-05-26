<?php

namespace Mjolnir\Gutenberg;

use Mjolnir\View\View;

class Block
{

    /**
     * @var View
     */
    private $view;
    /**
     * @var string
     */
    private $path;

    public function __construct(View $view, string $path)
    {
        $this->view = $view;
        $this->path = $path;
    }

    /**
     * @param string $namespace
     * @return Group
     */
    public function group(string $namespace): Group
    {
        return new Group($this, $namespace);
    }

    /**
     * @param string $namespace
     * @param string $name
     * @param string|null $path
     * @return Block
     */
    public function add(string $namespace, string $name, string $path = null): self
    {
        $path = $path ?? "{$this->path}/blocks/{$name}";
        $attributes = json_decode(file_get_contents("/{$path}/data/attributes.json"), true);

        $this->register("{$namespace}/{$name}", [
            'render_callback' => function ($attributes) use ($path) {
                $attributes = (object)$attributes;
                return $this->view->runString(file_get_contents("{$path}/view/block.blade.php"), ['attributes' => $attributes]);
            },
            'attributes' => $attributes,
        ]);

        return $this;
    }

    /**
     * @param $name
     * @param array $args
     */
    public function register($name, array $args = [])
    {
        register_block_type($name, $args);
    }

    /**
     * @param $name
     */
    public function unregister($name)
    {
        unregister_block_type($name);
    }

    /**
     * @param $resource
     * @param array $args
     */
    public function registerFromMetadata($resource, array $args = [])
    {
        register_block_type_from_metadata($resource, $args);
    }

    /**
     * @param string $blockName
     * @param null $post
     * @return bool
     */
    public function exists(string $blockName, $post = null): bool
    {
        return has_block($blockName, $post);
    }

    /**
     * @param array $parsedBlock
     * @return string
     */
    public function render(array $parsedBlock): string
    {
        return render_block($parsedBlock);
    }

    /**
     * @param string $content
     * @return array[]
     */
    public function parse(string $content): array
    {
        return parse_blocks($content);
    }

}
