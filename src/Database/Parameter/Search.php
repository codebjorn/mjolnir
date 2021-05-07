<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class Search
{
    use QueryParameter;

    /**
     * @var string|null
     */
    private $s;
    /**
     * @var bool|null
     */
    private $exact;
    /**
     * @var bool|null
     */
    private $sentence;

    /**
     * Search constructor.
     * @param string|null $s
     * @param bool|null $exact
     * @param bool|null $sentence
     */
    public function __construct(string $s = null, bool $exact = null, bool $sentence = null)
    {
        $this->s = $s;
        $this->exact = $exact;
        $this->sentence = $sentence;
    }

    /**
     * @return string|null
     */
    public function getS()
    {
        return $this->s;
    }

    /**
     * @param string|null $s
     */
    public function setS($s)
    {
        $this->s = $s;
    }

    /**
     * @return bool|null
     */
    public function getExact()
    {
        return $this->exact;
    }

    /**
     * @param bool|null $exact
     */
    public function setExact($exact)
    {
        $this->exact = $exact;
    }

    /**
     * @return bool|null
     */
    public function getSentence()
    {
        return $this->sentence;
    }

    /**
     * @param bool|null $sentence
     */
    public function setSentence($sentence)
    {
        $this->sentence = $sentence;
    }
}
