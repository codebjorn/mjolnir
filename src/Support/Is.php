<?php

namespace Mjolnir\Support;

use Mjolnir\Traits\Macroable;

class Is
{
    use Macroable;

    /**
     * @param $value
     * @return bool
     */
    public static function int($value): bool
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
    public static function float($value): bool
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
    public static function numeric($value): bool
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
    public static function bool($value): bool
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
    public static function str($value): bool
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
    public static function arr($value): bool
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
    public static function obj($value): bool
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
    public static function res($value): bool
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
    public static function callable($value): bool
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
    public static function scalar($value): bool
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
    public static function null($value): bool
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
    public static function dir($value): bool
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
    public static function file($value): bool
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
    public static function readable($value): bool
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
    public static function writable($value): bool
    {
        if (!\is_writable($value)) {
            return false;
        }

        return true;
    }
}
