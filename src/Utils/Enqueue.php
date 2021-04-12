<?php

namespace Mjolnir\Utils;

class Enqueue
{
    /**
     *
     */
    public static function all()
    {
        wp_enqueue_registered_block_scripts_and_styles();
    }

    /**
     * @param string $handle
     * @param string $src
     * @param array $deps
     * @param bool $ver
     * @param string $media
     */
    public static function style(string $handle, string $src = '', array $deps = [], bool $ver = false, string $media = 'all')
    {
        wp_enqueue_style($handle, $src, $deps, $ver, $media);
    }

    /**
     * @param string $handle
     * @param string $src
     * @param array $deps
     * @param bool $ver
     * @param bool $inFooter
     */
    public static function script(string $handle, string $src = '', array $deps = [], bool $ver = false, bool $inFooter = false)
    {
        wp_enqueue_script($handle, $src, $deps, $ver, $inFooter);
    }

    /**
     * @param array $args
     */
    public static function codeEditor(array $args)
    {
        wp_enqueue_code_editor($args);
    }

    /**
     *
     */
    public static function editor()
    {
        wp_enqueue_editor();
    }

    /**
     *
     */
    public static function editorAssets()
    {
        wp_enqueue_editor_block_directory_assets();
    }

    /**
     * @param array $args
     */
    public static function media(array $args = [])
    {
        wp_enqueue_media($args);
    }
}
