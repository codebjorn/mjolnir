<?php

namespace Mjolnir\Utils;

class Template
{
    /**
     * @param string $type
     * @param array $templates
     * @return string
     */
    public static function get(string $type, array $templates = [])
    {
        return get_query_template($type, $templates);
    }

    /**
     * @param $templateNames
     * @param false $load
     * @param bool $requireOnce
     * @param array $args
     * @return string
     */
    public static function locate($templateNames, $load = false, bool $requireOnce = true, $args = array())
    {
        return locate_template($templateNames, $load, $requireOnce, $args);
    }

    /**
     * @param string $templateFile
     * @param bool $requireOnce
     * @param array $args
     */
    public static function load(string $templateFile, bool $requireOnce = true, array $args = [])
    {
        load_template($templateFile, $requireOnce, $args);
    }
}
