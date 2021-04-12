<?php

namespace Mjolnir\Contracts;

interface HookShortcodeInterface
{
    public static function attributes(array $pairs, array $attrs, string $shortcode = '');

    public static function add(string $tag, $function);

    public static function remove(string $tag);

    public static function removeAll();

    public static function do(string $content, bool $ignoreHtml = false);
}
