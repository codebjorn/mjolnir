<?php

namespace Mjolnir\Gutenberg;

class Block
{

    /**
     * @param $name
     * @param array $args
     */
    public static function register($name, array $args = [])
    {
        register_block_type($name, $args);
    }

    /**
     * @param $name
     */
    public static function unregister($name)
    {
        unregister_block_type($name);
    }

    /**
     * @param $resource
     * @param array $args
     */
    public static function registerFromMetadata($resource, array $args = [])
    {
        register_block_type_from_metadata($resource, $args);
    }

    /**
     * @param string $blockName
     * @param null $post
     * @return bool
     */
    public static function exists(string $blockName, $post = null): bool
    {
        return has_block($blockName, $post);
    }

    /**
     * @param array $parsedBlock
     * @return string
     */
    public static function render(array $parsedBlock): string
    {
        return render_block($parsedBlock);
    }

    /**
     * @param string $content
     * @return array[]
     */
    public static function parse(string $content): array
    {
        return parse_blocks($content);
    }

}
