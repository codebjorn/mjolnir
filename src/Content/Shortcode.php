<?php

namespace Mjolnir\Content;

class Shortcode
{

    /**
     * @param array $pairs
     * @param array $attrs
     * @param string $shortcode
     * @return array
     */
    public static function attributes(array $pairs, array $attrs, string $shortcode = ''): array
    {
        return shortcode_atts($pairs, $attrs, $shortcode);
    }

    /**
     * @param string $tag
     * @param $function
     */
    public static function add(string $tag, $function)
    {
        add_shortcode($tag, $function);
    }

    /**
     * @param string $tag
     */
    public static function remove(string $tag)
    {
        remove_shortcode($tag);
    }

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
