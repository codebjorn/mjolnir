<?php

namespace Mjolnir\Hooks;

use Mjolnir\Contracts\HookShortcodeInterface;
use Mjolnir\Exceptions\HookResolverException;

class Shortcode implements HookShortcodeInterface
{

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
     * @throws HookResolverException
     */
    public static function add(string $tag, $function)
    {
        $resolvedFunction = HookResolver::resolve($function);

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
     * @return mixed
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
