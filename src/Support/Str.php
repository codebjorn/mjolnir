<?php


namespace Mjolnir\Support;

use Exception;

class Str
{
    private string $string;

    /**
     * @param string $string
     */
    public function __construct(string $string = '')
    {
        $this->string = $string;
    }

    /**
     * @param string $string
     * @return static
     */
    public static function make(string $string = '')
    {
        return new static($string);
    }

    /**
     * @param null $encoding
     * @return $this
     */
    public function lower($encoding = null)
    {
        return new static(mb_strtolower($this->string, $encoding));
    }

    /**
     * @param null $encoding
     * @return $this
     */
    public function upper($encoding = null)
    {
        return new static(mb_strtoupper($this->string, $encoding));
    }

    /**
     * @param int $length
     * @return array
     */
    public function split(int $length = 1)
    {
        return str_split($this->string, $length);
    }

    /**
     * @param $search
     * @param $replace
     * @param bool $registerSensitive
     * @return $this
     */
    public function replace($search, $replace, $registerSensitive = true)
    {
        $res = call_user_func($registerSensitive ? 'str_replace' : 'str_ireplace', $search, $replace, $this->string);
        return new static($res);
    }

    /**
     * @param string $charlist
     * @return $this
     */
    public function trim($charlist = " \t\n\r\0\x0B")
    {
        return new static(trim($this->string, $charlist));
    }

    /**
     * @param string $charlist
     * @return $this
     */
    public function ltrim($charlist = " \t\n\r\0\x0B")
    {
        return new static(ltrim($this->string, $charlist));
    }

    /**
     * @param string $charlist
     * @return $this
     */
    public function rtrim($charlist = " \t\n\r\0\x0B")
    {
        return new static(rtrim($this->string, $charlist));
    }

    /**
     * @param $delimiter
     * @param null $limit
     * @return Arr
     */
    public function explode($delimiter, $limit = null)
    {
        return Arr::make(explode($delimiter, $this->string, $limit));
    }

    /**
     * @return $this
     */
    public function upperFirst()
    {
        return new static(ucfirst($this->string));
    }

    /**
     * @return $this
     */
    public function lowerFirst()
    {
        return new static(lcfirst($this->string));
    }

    /**
     * @param bool $rawOutput
     * @return $this
     */
    public function md5(bool $rawOutput = false)
    {
        return new static(md5($this->string, $rawOutput));
    }

    /**
     * @param bool $xhtml
     * @return $this
     */
    public function nl2br(bool $xhtml = true)
    {
        return new static(nl2br($this->string, $xhtml));
    }

    /**
     * @param string $search
     * @param float|int $similarPercent
     * @return bool
     */
    public function isSimilar(string $search, float $similarPercent = 100)
    {
        similar_text($this->string, $search, $prc);
        return $prc >= $similarPercent;
    }

    /**
     * @return string
     */
    public function soundex()
    {
        return soundex($this->string);
    }

    /**
     * @param string $search
     * @return bool
     */
    public function soundLike(string $search)
    {
        return self::soundex() == self::soundex($search);
    }

    /**
     * @param int $count
     * @return $this
     */
    public function repeat(int $count)
    {
        return new static(str_repeat($this->string, $count));
    }

    /**
     * @return $this
     */
    public function shuffle()
    {
        return new static(str_shuffle($this->string));
    }

    /**
     * @return int|string[]
     */
    public function wordCount()
    {
        return str_word_count($this->string);
    }

    /**
     * @param string $search
     * @param bool $registerSensitive
     * @return false|mixed
     */
    public function equal(string $search, $registerSensitive = true)
    {
        return call_user_func($registerSensitive ? 'strcmp' : 'strcasecmp', $this->string, $search);
    }

    /**
     * @param null $encoding
     * @return false|int
     */
    public function length($encoding = null)
    {
        return mb_strlen($this->string, $encoding);
    }

    /**
     * @return $this
     */
    public function flip()
    {
        return new static(strrev($this->string));
    }

    /**
     * @param string $search
     * @return $this
     */
    public function before(string $search)
    {
        return new static(strstr($this->string, $search, true));
    }

    /**
     * @param string $search
     * @return $this
     */
    public function after(string $search)
    {
        return new static(substr($this->string, strpos($this->string, "_") + strlen($search)));
    }

    /**
     * @param string $from
     * @param string $to
     * @return $this|string
     */
    public function between(string $from, string $to)
    {
        $string = ' ' . $this->string;
        $ini = strpos($string, $from);
        if ($ini == 0) return '';
        $ini += strlen($from);
        $len = strpos($string, $to, $ini) - $ini;
        return new static(substr($string, $ini, $len));
    }

    /**
     * @param string $search
     * @return bool
     */
    public function has(string $search)
    {
        return substr_count($this->string, $search) > 0;
    }

    /**
     * @param array $search
     * @return bool
     */
    public function hasAll(array $search)
    {

        foreach ($search as $word)
            if (!$this->has($word))
                return false;

        return true;
    }

    /**
     * @param string $delimiters
     * @return $this
     */
    public function upperWords($delimiters = " \t\r\n\f\v")
    {
        return new static(ucwords($this->string, $delimiters));
    }

    /**
     * @param $pattern
     * @param $replace
     * @return $this
     */
    public function pregReplace($pattern, $replace)
    {
        return new static(preg_replace($pattern, $replace, $this->string));
    }

    /**
     * @param string $delimiter
     * @return string|Str
     */
    public function snake($delimiter = '_')
    {
        if (ctype_lower($this->string)) {
            return $this->string;
        }

        return $this->upperWords()
            ->pregReplace('/\s+/u', '')
            ->pregReplace('/(.)(?=[A-Z])/u', '$1' . $delimiter)
            ->lower();
    }

    /**
     * @return string|Str
     */
    public function kebab()
    {
        return $this->snake('-');
    }

    /**
     * @param int $words
     * @param string $end
     * @return $this|string
     */
    public function words($words = 100, $end = '...')
    {
        preg_match('/^\s*+(?:\S++\s*+){1,' . $words . '}/u', $this->string, $matches);

        if (!isset($matches[0]) || $this->length() === static::make($matches[0])->length()) {
            return $this->string;
        }

        return new static(static::make($matches[0])->rtrim() . $end);
    }

    /**
     * @param int $length
     * @return string
     * @throws Exception
     */
    public static function random(int $length = 16)
    {
        $string = '';

        while (($len = strlen($string)) < $length) {
            $size = $length - $len;
            $bytes = random_bytes($size);
            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $string;
    }

    /**
     * @param string $encoding
     * @return $this
     */
    public function title($encoding = 'UTF-8')
    {
        return new static(mb_convert_case($this->string, MB_CASE_TITLE, $encoding));
    }

    /**
     * @param array $delimiters
     * @return Str
     */
    public function studly(array $delimiters = [])
    {
        return $this->kebab()
            ->replace(['-', '_'] + $delimiters, ' ')
            ->upperWords()
            ->replace(' ', '');
    }

    /**
     * @return $this
     */
    public function camel()
    {
        return $this->studly()
            ->lowerFirst();
    }

    /**
     * @param $start
     * @param null $length
     * @param string $encoding
     * @return $this
     */
    public function cut($start, $length = null, $encoding = 'UTF-8')
    {
        return new static(mb_substr($this->string, $start, $length, $encoding));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->string;
    }
}
