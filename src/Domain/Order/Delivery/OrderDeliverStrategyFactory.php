<?php
declare(strict_types=1);

namespace App\Domain\Order\Delivery;

use App\Domain\Order\DeliveryType;
use App\Infrastructure\External\EnterpriseValidator;

class OrderDeliverStrategyFactory
{
    public function create(DeliveryType $deliveryType): OrderDelivererInterface
    {
        switch ($deliveryType->value()) {
            case DeliveryType::PERSONAL_DELIVERY:
                return new PersonalDeliverer();
            case DeliveryType::PERSONAL_DELIVERY_EXPRESS:
                return new ExpressOrderDeliverer();
            case DeliveryType::ENTERPRISE_DELIVERY:
                return new EnterpriseDeliverer(new EnterpriseValidator());
        }
    }
}
