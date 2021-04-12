<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameterable;

class Author
{
    use QueryParameterable;

    private ?int $author;
    private ?string $author_name;
    private ?array $author__in;
    private ?array $author__not_in;

    public function __construct(int $author = null, string $author_name = null, array $author__in = null, array $author__not_in = null)
    {
        $this->author = $author;
        $this->author_name = $author_name;
        $this->author__in = $author__in;
        $this->author__not_in = $author__not_in;
    }

    /**
     * @return int|null
     */
    public function getAuthor(): ?int
    {
        return $this->author;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->author_name;
    }

    /**
     * @return array|null
     */
    public function getIn(): ?array
    {
        return $this->author__in;
    }

    /**
     * @return array|null
     */
    public function getNotIn(): ?array
    {
        return $this->author__not_in;
    }

    /**
     * @param int|null $author
     */
    public function setAuthor(?int $author): void
    {
        $this->author = $author;
    }

    /**
     * @param string|null $author_name
     */
    public function setName(?string $author_name): void
    {
        $this->author_name = $author_name;
    }

    /**
     * @param array|null $author__in
     */
    public function setIn(?array $author__in): void
    {
        $this->author__in = $author__in;
    }

    /**
     * @param array|null $author__not_in
     */
    public function setNotIn(?array $author__not_in): void
    {
        $this->author__not_in = $author__not_in;
    }

}
