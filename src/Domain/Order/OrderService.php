<?php
declare(strict_types=1);

namespace App\Domain\Order;

use App\Application\Actions\Order\Command\CreateOrder;
use App\Application\Actions\Order\Command\Director;
use App\Domain\Enterprise\Enterprise;
use App\Domain\Order\Delivery\OrderDeliverStrategyFactory;
use App\Domain\Order\Event\OrderDeliveredEvent;
use App\Domain\Order\Exception\InvalidDeliveryException;
use App\Domain\Order\Exception\InvalidOrderException;
use Symfony\Component\EventDispatcher\EventDispatcher;

class OrderService
{
    /** @var OrderDeliverStrategyFactory */
    private $deliverStrategyFactory;
    /** @var EventDispatcher */
    private $dispatcher;

    public function __construct(OrderDeliverStrategyFactory $deliverStrategyFactory, EventDispatcher $dispatcher)
    {
        $this->deliverStrategyFactory = $deliverStrategyFactory;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param CreateOrder $command
     * @throws InvalidDeliveryException
     * @throws InvalidOrderException
     */
    public function deliver(CreateOrder $command)
    {
        $order = new Order(
            new Customer($command->getCustomer()->getName(), $command->getCustomer()->getAddress()),
            OrderSource::memberByValue($command->getSource()),
            DeliveryType::memberByValue($command->getDeliveryType()),
            $command->getWeight()
        );
        if ($command->hasCampaign()) {
            $order->addCampaign(
                new Campaign(
                    $command->getCampaign()->getName(),
                    $command->getCampaign()->getType(),
                    $command->getCampaign()->getAd()
                )
            );
        }
        if ($command->hasEnterprise()) {
            $order->associateTo(new Enterprise(
                $command->getEnterprise()->getName(),
                $command->getEnterprise()->getType(),
                $command->getEnterprise()->getAbn(),
                array_map(function (Director $director) {
                    return new \App\Domain\Enterprise\Director($director->getName(), $director->getAddress());
                }, $command->getEnterprise()->getDirectors())
            ));
        }
        $this->deliverStrategyFactory->create(
            DeliveryType::memberByValue($command->getDeliveryType())
        )->deliver($order);

        $this->dispatcher->dispatch(new OrderDeliveredEvent($order));
    }
}
