<?php

namespace Mjolnir\Admin;

use Mjolnir\Container\ContainerResolver;
use Mjolnir\Traits\GetContainer;

class Shortcode
{
    use GetContainer;

    /**
     * @param array $pairs
     * @param array $attrs
     * @param string $shortcode
     * @return array
     */
    public static function attributes(array $pairs, array $attrs, string $shortcode = '')
    {
        return shortcode_atts($pairs, $attrs, $shortcode);
    }

    /**
     * @param string $tag
     * @param $function
     */
    public static function add(string $tag, $function)
    {
        $resolvedFunction = ContainerResolver::resolve($function);

        add_shortcode($tag, $resolvedFunction);
    }

    /**
     * @param string $tag
     */
    public static function remove(string $tag)
    {
        remove_shortcode($tag);
    }

    /**
     *
     */
    public static function removeAll()
    {
        remove_all_shortcodes();
    }

    /**
     * @param string $content
     * @param bool $ignoreHtml
     */
    public static function do(string $content, bool $ignoreHtml = false)
    {
        do_shortcode($content, $ignoreHtml);
    }
}
