<?php
declare(strict_types=1);

namespace App\Domain\Order;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * @method static OrderSource WEB()
 * @method static OrderSource EMAIL()
 * @method static OrderSource DIRECT()
 */
class OrderSource extends AbstractEnumeration
{
    public const WEB = 'web';
    public const EMAIL = 'email';
    public const DIRECT = 'direct';
}
