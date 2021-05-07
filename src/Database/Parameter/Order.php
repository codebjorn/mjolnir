<?php

namespace Mjolnir\Database\Parameter;

use Mjolnir\Traits\QueryParameter;

class Order
{
    use QueryParameter;

    /**
     * @var string|null
     */
    private $order;
    /**
     * @var string|null
     */
    private $orderby;

    /**
     * Order constructor.
     * @param string|null $order
     * @param string|null $orderby
     */
    public function __construct(string $order = null, string $orderby = null)
    {
        $this->order = $order;
        $this->orderby = $orderby;
    }

    /**
     * @return string|null
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string|null $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return string|null
     */
    public function getOrderby()
    {
        return $this->orderby;
    }

    /**
     * @param string|null $orderby
     */
    public function setOrderby($orderby)
    {
        $this->orderby = $orderby;
    }
}
