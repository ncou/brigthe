<?php
declare(strict_types=1);

namespace App\Domain\Order;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * @method static DeliveryType PERSONAL_DELIVERY()
 * @method static DeliveryType PERSONAL_DELIVERY_EXPRESS()
 * @method static DeliveryType ENTERPRISE_DELIVERY()
 */
class DeliveryType extends AbstractEnumeration
{
    public const PERSONAL_DELIVERY = 'personalDelivery';
    public const PERSONAL_DELIVERY_EXPRESS = 'personalDeliveryExpress';
    public const ENTERPRISE_DELIVERY = 'enterpriseDelivery';
}
