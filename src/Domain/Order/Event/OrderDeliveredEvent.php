<?php
declare(strict_types=1);

namespace App\Domain\Order\Event;

use App\Domain\Order\Order;
use Symfony\Contracts\EventDispatcher\Event;

class OrderDeliveredEvent extends Event
{
    public const NAME = 'order.delivered';
    /** @var Order */
    private $order;
    /** @var \DateTimeImmutable  */
    private $createdAt;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->createdAt = new \DateTimeImmutable();
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
