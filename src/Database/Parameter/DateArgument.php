<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameterable;

class DateArgument
{
    use QueryParameterable;

    private ?int $year;
    private ?int $month;
    private ?int $week;
    private ?int $day;
    private ?int $hour;
    private ?int $minute;
    private ?int $second;
    /**
     * @var null|string|array
     */
    private $after;
    /**
     * @var null|string|array
     */
    private $before;
    private ?bool $inclusive;
    private ?string $compare;
    private ?string $column;
    private ?string $relation;

    public function __construct(int $year = null, int $month = null, int $week = null, int $day = null, int $hour = null, int $minute = null, int $second = null, $after = null, $before = null, bool $inclusive = null, string $compare = null, string $column = null, string $relation = null)
    {
        $this->year = $year;
        $this->month = $month;
        $this->week = $week;
        $this->day = $day;
        $this->hour = $hour;
        $this->minute = $minute;
        $this->second = $second;
        $this->after = $after;
        $this->before = $before;
        $this->inclusive = $inclusive;
        $this->compare = $compare;
        $this->column = $column;
        $this->relation = $relation;
    }

    /**
     * @return int|null
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * @param int|null $year
     */
    public function setYear(?int $year): void
    {
        $this->year = $year;
    }

    /**
     * @return int|null
     */
    public function getMonth(): ?int
    {
        return $this->month;
    }

    /**
     * @param int|null $month
     */
    public function setMonth(?int $month): void
    {
        $this->month = $month;
    }

    /**
     * @return int|null
     */
    public function getWeek(): ?int
    {
        return $this->week;
    }

    /**
     * @param int|null $week
     */
    public function setWeek(?int $week): void
    {
        $this->week = $week;
    }

    /**
     * @return int|null
     */
    public function getDay(): ?int
    {
        return $this->day;
    }

    /**
     * @param int|null $day
     */
    public function setDay(?int $day): void
    {
        $this->day = $day;
    }

    /**
     * @return int|null
     */
    public function getHour(): ?int
    {
        return $this->hour;
    }

    /**
     * @param int|null $hour
     */
    public function setHour(?int $hour): void
    {
        $this->hour = $hour;
    }

    /**
     * @return int|null
     */
    public function getMinute(): ?int
    {
        return $this->minute;
    }

    /**
     * @param int|null $minute
     */
    public function setMinute(?int $minute): void
    {
        $this->minute = $minute;
    }

    /**
     * @return int|null
     */
    public function getSecond(): ?int
    {
        return $this->second;
    }

    /**
     * @param int|null $second
     */
    public function setSecond(?int $second): void
    {
        $this->second = $second;
    }

    /**
     * @return array|string|null
     */
    public function getAfter()
    {
        return $this->after;
    }

    /**
     * @param array|string|null $after
     */
    public function setAfter($after): void
    {
        $this->after = $after;
    }

    /**
     * @return array|string|null
     */
    public function getBefore()
    {
        return $this->before;
    }

    /**
     * @param array|string|null $before
     */
    public function setBefore($before): void
    {
        $this->before = $before;
    }

    /**
     * @return bool|null
     */
    public function getInclusive(): ?bool
    {
        return $this->inclusive;
    }

    /**
     * @param bool|null $inclusive
     */
    public function setInclusive(?bool $inclusive): void
    {
        $this->inclusive = $inclusive;
    }

    /**
     * @return string|null
     */
    public function getCompare(): ?string
    {
        return $this->compare;
    }

    /**
     * @param string|null $compare
     */
    public function setCompare(?string $compare): void
    {
        $this->compare = $compare;
    }

    /**
     * @return string|null
     */
    public function getColumn(): ?string
    {
        return $this->column;
    }

    /**
     * @param string|null $column
     */
    public function setColumn(?string $column): void
    {
        $this->column = $column;
    }

    /**
     * @return string|null
     */
    public function getRelation(): ?string
    {
        return $this->relation;
    }

    /**
     * @param string|null $relation
     */
    public function setRelation(?string $relation): void
    {
        $this->relation = $relation;
    }
}
