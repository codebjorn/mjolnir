<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Support\Collection;
use Mjolnir\Support\Is;
use Mjolnir\Traits\QueryParameter;

class Date
{
    use QueryParameter;

    /**
     * @var array|null
     */
    private $date_query;
    /**
     * @var int|null
     */
    private $year;
    /**
     * @var int|null
     */
    private $monthnum;
    /**
     * @var int|null
     */
    private $w;
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
     * @var int|null
     */
    private $m;

    /**
     * Date constructor.
     * @param array|null $date_query
     * @param int|null $year
     * @param int|null $monthnum
     * @param int|null $w
     * @param int|null $day
     * @param int|null $hour
     * @param int|null $minute
     * @param int|null $second
     * @param int|null $m
     */
    public function __construct(array $date_query = null, int $year = null, int $monthnum = null, int $w = null, int $day = null, int $hour = null, int $minute = null, int $second = null, int $m = null)
    {
        $this->date_query = $date_query;
        $this->year = $year;
        $this->monthnum = $monthnum;
        $this->w = $w;
        $this->day = $day;
        $this->hour = $hour;
        $this->minute = $minute;
        $this->second = $second;
        $this->m = $m;
    }

    /**
     * @return array
     */
    public function getDateQuery(): array
    {
        return $this->date_query;
    }

    /**
     * @param array $date_query
     */
    public function setDateQuery(array $date_query)
    {
        $this->date_query = $date_query;
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
    public function getMonthnum()
    {
        return $this->monthnum;
    }

    /**
     * @param int|null $monthnum
     */
    public function setMonthnum($monthnum)
    {
        $this->monthnum = $monthnum;
    }

    /**
     * @return int|null
     */
    public function getW()
    {
        return $this->w;
    }

    /**
     * @param int|null $w
     */
    public function setW($w)
    {
        $this->w = $w;
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
     * @return int|null
     */
    public function getM()
    {
        return $this->m;
    }

    /**
     * @param int|null $m
     */
    public function setM($m)
    {
        $this->m = $m;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $props = Collection::make(get_class_vars(static::class));
        $resolvedProps = $props->map(function ($item, $index) {
            if ($index === "date_query") {
                return Collection::make($this->{$index} ?? [])
                    ->map(function ($class) {
                        return Is::obj($class) ? $class->toArray() : $class;
                    })
                    ->toArray();
            }

            return $this->{$index};
        });

        return $resolvedProps->filter(function ($item) {
            return $item !== null;
        })
            ->toArray();
    }
}
