<?php


namespace Mjolnir\Utils;

class ThemeMod
{
    /**
     * @return array|false|void
     */
    public function all()
    {
        return get_theme_mods();
    }

    /**
     * @param string $name
     * @param false $default
     * @return mixed
     */
    public function get(string $name, bool $default = false)
    {
        return get_theme_mod($name, $default);
    }

    /**
     * @param string $name
     * @param $value
     */
    public function set(string $name, $value)
    {
        set_theme_mod($name, $value);
    }

    public function removeAll()
    {
        remove_theme_mods();
    }

    /**
     * @param string $name
     */
    public function remove(string $name)
    {
        remove_theme_mod($name);
    }
}
