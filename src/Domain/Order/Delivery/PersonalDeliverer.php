<?php
declare(strict_types=1);

namespace App\Domain\Order\Delivery;


use App\Domain\Order\Order;

class PersonalDeliverer implements OrderDelivererInterface
{

    public function deliver(Order $order): void
    {
        // Do something
        $t = 1;
    }
}
