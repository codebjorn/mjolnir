<?php


namespace Mjolnir\Utils;

class Theme
{
    /**
     * @param string $feature
     * @param mixed ...$args
     */
    public static function support(string $feature, ...$args)
    {
        add_theme_support($feature, $args);
    }

    /**
     * @param string $domain
     * @param false $path
     */
    public static function textDomain(string $domain, $path = false)
    {
        load_theme_textdomain($domain, $path);
    }

    /**
     * @return ThemeMod
     */
    public static function mod()
    {
        return new ThemeMod();
    }
}
