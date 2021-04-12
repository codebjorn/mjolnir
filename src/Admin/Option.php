<?php

namespace Mjolnir\Admin;

class Option
{
    /**
     * @param string $option
     * @param false $default
     * @return false|mixed|void
     */
    public static function get(string $option, $default = false)
    {
        return get_option($option, $default);
    }

    /**
     * @param string $option
     * @param $value
     * @param null $autoload
     * @return bool
     */
    public static function update(string $option, $value, $autoload = null)
    {
        return update_option($option, $value, $autoload);
    }

    /**
     * @param string $option
     * @param string $value
     * @return bool
     */
    public static function add(string $option, $value = '')
    {
        return add_option($option, $value);
    }

    /**
     * @param string $option
     * @return bool
     */
    public static function delete(string $option)
    {
        return delete_option($option);
    }

    /**
     * @param int $networkId
     * @param string $option
     * @param false $default
     * @return false|mixed
     */
    public static function getNetwork(int $networkId, string $option, $default = false)
    {
        return get_network_option($networkId, $option, $default);
    }

    /**
     * @param int $networkId
     * @param string $option
     * @param string $value
     * @return bool
     */
    public static function updateNetwork(int $networkId, string $option, $value = '')
    {
        return update_network_option($networkId, $option, $value);
    }

    /**
     * @param int $networkId
     * @param string $option
     * @param string $value
     * @return bool
     */
    public static function addNetwork(int $networkId, string $option, $value = '')
    {
        return add_network_option($networkId, $option, $value);
    }

    /**
     * @param int $networkId
     * @param string $option
     * @return bool
     */
    public static function deleteNetwork(int $networkId, string $option)
    {
        return delete_network_option($networkId, $option);
    }

}
