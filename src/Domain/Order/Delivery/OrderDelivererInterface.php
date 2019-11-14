<?php

namespace App\Domain\Order\Delivery;

use App\Domain\Order\Exception\InvalidOrderException;
use App\Domain\Order\Order;

interface OrderDelivererInterface
{
    /**
     * @param Order $orderData
     * @throws InvalidOrderException
     */
    public function deliver(Order $orderData): void;
}
