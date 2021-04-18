<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class Order
{
    use QueryParameter;

    private ?string $order;
    private ?string $orderby;

    public function __construct(string $order = null, string $orderby = null)
    {
        $this->order = $order;
        $this->orderby = $orderby;
    }

    /**
     * @return string|null
     */
    public function getOrder(): ?string
    {
        return $this->order;
    }

    /**
     * @param string|null $order
     */
    public function setOrder(?string $order): void
    {
        $this->order = $order;
    }

    /**
     * @return string|null
     */
    public function getOrderby(): ?string
    {
        return $this->orderby;
    }

    /**
     * @param string|null $orderby
     */
    public function setOrderby(?string $orderby): void
    {
        $this->orderby = $orderby;
    }
}
