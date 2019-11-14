<?php
declare(strict_types=1);

namespace App\Application\Actions\Order\Command;

class CreateOrder
{
    /** @var Customer */
    private $customer;
    /** @var string */
    private $deliveryType;
    /** @var string */
    private $source;
    /** @var int */
    private $weight;
    /** @var Enterprise */
    private $enterprise;
    /** @var Campaign */
    private $campaign;

    public function __construct(Customer $customer, string $deliveryType, string $source, int $weight)
    {
        $this->customer = $customer;
        $this->deliveryType = $deliveryType;
        $this->source = $source;
        $this->weight = $weight;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @return string
     */
    public function getDeliveryType(): string
    {
        return $this->deliveryType;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param Enterprise $enterprise
     */
    public function setEnterprise(Enterprise $enterprise)
    {
        $this->enterprise = $enterprise;
    }

    /**
     * @return bool
     */
    public function hasEnterprise(): bool
    {
        return !empty($this->enterprise);
    }

    /**
     * @return Enterprise
     */
    public function getEnterprise(): Enterprise
    {
        return $this->enterprise;
    }

    /**
     * @param Campaign $campaign
     */
    public function setCampaign(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function hasCampaign(): bool
    {
        return !empty($this->campaign);
    }

    /**
     * @return Campaign
     */
    public function getCampaign(): Campaign
    {
        return $this->campaign;
    }
}
