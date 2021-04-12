<?php

namespace Mjolnir\Support;

class Is
{

    /**
     * @param $value
     * @return bool
     */
    public static function int($value)
    {
        if (!\is_int($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function float($value)
    {
        if (!\is_float($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function numeric($value)
    {
        if (!\is_numeric($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function bool($value)
    {
        if (!\is_bool($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function str($value)
    {
        if (!\is_string($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function arr($value)
    {
        if (!\is_array($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function obj($value)
    {
        if (!\is_object($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function res($value)
    {
        if (!\is_resource($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function callable($value)
    {
        if (!\is_callable($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function scalar($value)
    {
        if (!\is_scalar($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function null($value)
    {
        if (!\is_null($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function dir($value)
    {
        if (!\is_dir($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function file($value)
    {
        if (!\is_file($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function readable($value)
    {
        if (!\is_readable($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function writable($value)
    {
        if (!\is_writable($value)) {
            return false;
        }

        return true;
    }
}
