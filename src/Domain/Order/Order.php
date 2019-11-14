<?php
declare(strict_types=1);

namespace App\Domain\Order;

use App\Domain\Enterprise\Enterprise;
use App\Domain\Enterprise\NoEnterprise;
use App\Domain\Order\Exception\InvalidDeliveryException;

class Order
{
    /** @var Customer */
    private $customer;
    /** @var OrderSource */
    private $source;
    /** @var DeliveryType */
    private $deliveryType;
    /** @var int */
    private $weight;
    /** @var Campaign */
    private $campaign;
    /** @var Enterprise */
    private $enterprise;

    public function __construct(Customer $customer, OrderSource $source, DeliveryType $deliveryType, int $weight)
    {
        $this->customer = $customer;
        $this->source = $source;
        $this->deliveryType = $deliveryType;
        $this->weight = $weight;
        $this->enterprise = new NoEnterprise();
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @return OrderSource
     */
    public function getSource(): OrderSource
    {
        return $this->source;
    }

    /**
     * @return DeliveryType
     */
    public function getDeliveryType(): DeliveryType
    {
        return $this->deliveryType;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param Campaign $campaign
     */
    public function addCampaign(Campaign $campaign): void
    {
        $this->campaign = $campaign;
    }

    /**
     * @return bool
     */
    public function isFromCampaign(): bool
    {
        return !empty($this->campaign);
    }

    /**
     * @param Enterprise $enterprise
     * @throws InvalidDeliveryException
     */
    public function associateTo(Enterprise $enterprise): void
    {
        if ($this->deliveryType !== DeliveryType::ENTERPRISE_DELIVERY()) {
            throw new InvalidDeliveryException('Incorrect delivery type for the requested association');
        }
        $this->enterprise = $enterprise;
    }

    /**
     * @return Enterprise
     */
    public function getEnterprise(): Enterprise
    {
        return $this->enterprise;
    }

    /**
     * @return bool
     */
    public function isForEnterprise(): bool
    {
        return !$this->enterprise instanceof NoEnterprise;
    }
}
