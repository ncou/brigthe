<?php
declare(strict_types=1);

namespace App\Domain\Order\Delivery;

use App\Domain\Enterprise\EnterpriseValidatorInterface;
use App\Domain\Order\Exception\InvalidOrderException;
use App\Domain\Order\Order;

class EnterpriseDeliverer implements OrderDelivererInterface
{

    /** @var EnterpriseValidatorInterface */
    private $enterpriseValidator;

    public function __construct(EnterpriseValidatorInterface $enterpriseValidator)
    {
        $this->enterpriseValidator = $enterpriseValidator;
    }

    public function deliver(Order $order): void
    {
        if(!$this->enterpriseValidator->validate($order->getEnterprise())) {
            throw new InvalidOrderException('Something went wrong validating enterprise order');
        }
    }
}
