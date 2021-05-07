<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class DateArgument
{
    use QueryParameter;

    /**
     * @var int|null
     */
    private $year;
    /**
     * @var int|null
     */
    private $month;
    /**
     * @var int|null
     */
    private $week;
    /**
     * @var int|null
     */
    private $day;
    /**
     * @var int|null
     */
    private $hour;
    /**
     * @var int|null
     */
    private $minute;
    /**
     * @var int|null
     */
    private $second;
    /**
     * @var null|string|array
     */
    private $after;
    /**
     * @var null|string|array
     */
    private $before;
    /**
     * @var bool|null
     */
    private $inclusive;
    /**
     * @var string|null
     */
    private $compare;
    /**
     * @var string|null
     */
    private $column;
    /**
     * @var string|null
     */
    private $relation;

    /**
     * DateArgument constructor.
     * @param int|null $year
     * @param int|null $month
     * @param int|null $week
     * @param int|null $day
     * @param int|null $hour
     * @param int|null $minute
     * @param int|null $second
     * @param null $after
     * @param null $before
     * @param bool|null $inclusive
     * @param string|null $compare
     * @param string|null $column
     * @param string|null $relation
     */
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
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int|null $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return int|null
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param int|null $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * @return int|null
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * @param int|null $week
     */
    public function setWeek($week)
    {
        $this->week = $week;
    }

    /**
     * @return int|null
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param int|null $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * @return int|null
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * @param int|null $hour
     */
    public function setHour($hour)
    {
        $this->hour = $hour;
    }

    /**
     * @return int|null
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * @param int|null $minute
     */
    public function setMinute($minute)
    {
        $this->minute = $minute;
    }

    /**
     * @return int|null
     */
    public function getSecond()
    {
        return $this->second;
    }

    /**
     * @param int|null $second
     */
    public function setSecond($second)
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
    public function setAfter($after)
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
    public function setBefore($before)
    {
        $this->before = $before;
    }

    /**
     * @return bool|null
     */
    public function getInclusive()
    {
        return $this->inclusive;
    }

    /**
     * @param bool|null $inclusive
     */
    public function setInclusive($inclusive)
    {
        $this->inclusive = $inclusive;
    }

    /**
     * @return string|null
     */
    public function getCompare()
    {
        return $this->compare;
    }

    /**
     * @param string|null $compare
     */
    public function setCompare($compare)
    {
        $this->compare = $compare;
    }

    /**
     * @return string|null
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * @param string|null $column
     */
    public function setColumn($column)
    {
        $this->column = $column;
    }

    /**
     * @return string|null
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * @param string|null $relation
     */
    public function setRelation($relation)
    {
        $this->relation = $relation;
    }
}
