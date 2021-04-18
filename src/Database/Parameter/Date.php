<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Support\Collection;
use Mjolnir\Support\Is;
use Mjolnir\Traits\QueryParameter;

class Date
{
    use QueryParameter;

    private ?array $date_query;
    private ?int $year;
    private ?int $monthnum;
    private ?int $w;
    private ?int $day;
    private ?int $hour;
    private ?int $minute;
    private ?int $second;
    private ?int $m;

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
    public function setDateQuery(array $date_query): void
    {
        $this->date_query = $date_query;
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
    public function getMonthnum(): ?int
    {
        return $this->monthnum;
    }

    /**
     * @param int|null $monthnum
     */
    public function setMonthnum(?int $monthnum): void
    {
        $this->monthnum = $monthnum;
    }

    /**
     * @return int|null
     */
    public function getW(): ?int
    {
        return $this->w;
    }

    /**
     * @param int|null $w
     */
    public function setW(?int $w): void
    {
        $this->w = $w;
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
     * @return int|null
     */
    public function getM(): ?int
    {
        return $this->m;
    }

    /**
     * @param int|null $m
     */
    public function setM(?int $m): void
    {
        $this->m = $m;
    }

    public function toArray()
    {
        $props = Collection::make(get_class_vars(static::class));
        $resolvedProps = $props->map(function ($item, $index) {
            if ($index === "date_query") {
                return Collection::make($this->{$index} ?? [])
                    ->map(fn($class) => Is::obj($class) ? $class->toArray() : $class)
                    ->toArray();
            }

            return $this->{$index};
        });

        return $resolvedProps->filter(fn($item) => $item !== null)
            ->toArray();
    }
}
