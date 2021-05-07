<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class Author
{
    use QueryParameter;

    /**
     * @var int|null
     */
    private $author;
    /**
     * @var string|null
     */
    private $author_name;
    /**
     * @var array|null
     */
    private $author__in;
    /**
     * @var array|null
     */
    private $author__not_in;

    /**
     * Author constructor.
     * @param int|null $author
     * @param string|null $author_name
     * @param array|null $author__in
     * @param array|null $author__not_in
     */
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
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->author_name;
    }

    /**
     * @return array|null
     */
    public function getIn()
    {
        return $this->author__in;
    }

    /**
     * @return array|null
     */
    public function getNotIn()
    {
        return $this->author__not_in;
    }

    /**
     * @param int|null $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @param string|null $author_name
     */
    public function setName($author_name)
    {
        $this->author_name = $author_name;
    }

    /**
     * @param array|null $author__in
     */
    public function setIn($author__in)
    {
        $this->author__in = $author__in;
    }

    /**
     * @param array|null $author__not_in
     */
    public function setNotIn($author__not_in)
    {
        $this->author__not_in = $author__not_in;
    }

}
