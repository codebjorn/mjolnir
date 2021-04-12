<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameterable;

class Search
{
    use QueryParameterable;

    private ?string $s;
    private ?bool $exact;
    private ?bool $sentence;

    public function __construct(string $s = null, bool $exact = null, bool $sentence = null)
    {
        $this->s = $s;
        $this->exact = $exact;
        $this->sentence = $sentence;
    }

    /**
     * @return string|null
     */
    public function getS(): ?string
    {
        return $this->s;
    }

    /**
     * @param string|null $s
     */
    public function setS(?string $s): void
    {
        $this->s = $s;
    }

    /**
     * @return bool|null
     */
    public function getExact(): ?bool
    {
        return $this->exact;
    }

    /**
     * @param bool|null $exact
     */
    public function setExact(?bool $exact): void
    {
        $this->exact = $exact;
    }

    /**
     * @return bool|null
     */
    public function getSentence(): ?bool
    {
        return $this->sentence;
    }

    /**
     * @param bool|null $sentence
     */
    public function setSentence(?bool $sentence): void
    {
        $this->sentence = $sentence;
    }
}
