<?php
declare(strict_types=1);

namespace Tests\Domain;

use App\Application\Actions\Order\Command\Campaign;
use App\Application\Actions\Order\Command\CreateOrder;
use App\Application\Actions\Order\Command\Customer;
use App\Application\Actions\Order\Command\Director;
use App\Application\Actions\Order\Command\Enterprise;
use App\Domain\Order\Delivery\EnterpriseDeliverer;
use App\Domain\Order\Delivery\ExpressOrderDeliverer;
use App\Domain\Order\Delivery\OrderDeliverStrategyFactory;
use App\Domain\Order\Delivery\PersonalDeliverer;
use App\Domain\Order\DeliveryType;
use App\Domain\Order\Event\OrderDeliveredEvent;
use App\Domain\Order\Exception\InvalidDeliveryException;
use App\Domain\Order\OrderService;
use Bigcommerce\MockInjector\AutoMockingTest;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcher;

class OrderServiceTest extends AutoMockingTest
{
    public function testCreateOrderPersonalDeliverer()
    {
        $subject = $this->injector->create(OrderService::class);

        $createSimpleOrder = new CreateOrder(
            new Customer('Johnny Bravo', '56 Pitt Street, 2000, Sydney'),
            'personalDelivery',
            'web',
            1500
        );
        $orderDeliverer = $this->prophesize(PersonalDeliverer::class);
        $this->injector->getProphecy(OrderDeliverStrategyFactory::class)
            ->create(DeliveryType::PERSONAL_DELIVERY())
            ->willReturn($orderDeliverer->reveal());
        $this->injector->getProphecy(EventDispatcher::class)
            ->dispatch(Argument::type(OrderDeliveredEvent::class))->shouldBeCalled();
        $subject->deliver($createSimpleOrder);
    }

    public function testCreateOrderExpressDeliverer()
    {
        $subject = $this->injector->create(OrderService::class);

        $createSimpleOrder = new CreateOrder(
            new Customer('Jack Ripper', '822 Anzac Parade, 2035, Maroubra'),
            'personalDeliveryExpress',
            'email',
            2000
        );
        $createSimpleOrder->setCampaign(new Campaign(
            'Christmas2018',
            'holiday',
            'opportunity'
        ));
        $orderDeliverer = $this->prophesize(ExpressOrderDeliverer::class);
        $this->injector->getProphecy(OrderDeliverStrategyFactory::class)
            ->create(DeliveryType::PERSONAL_DELIVERY_EXPRESS())
            ->willReturn($orderDeliverer->reveal());
        $this->injector->getProphecy(EventDispatcher::class)
            ->dispatch(Argument::type(OrderDeliveredEvent::class))->shouldBeCalled();
        $subject->deliver($createSimpleOrder);
    }

    public function testCreateOrderEnterpriseDeliverer()
    {
        $subject = $this->injector->create(OrderService::class);

        $createSimpleOrder = new CreateOrder(
            new Customer('Elvis Presley', '333 George Street, 2000, Sydney'),
            'enterpriseDelivery',
            'direct',
            2000
        );
        $createSimpleOrder->setEnterprise(new Enterprise(
            'Bayview Motel',
            'PtyLtd',
            'SN123OK',
            [
                new Director('Michael Jackskon', '242 Bayview, 2434, Sydney'),
                new Director('Freddie Mercury', '132 Coast, 2354, Newcastle')
            ]
        ));
        $orderDeliverer = $this->prophesize(EnterpriseDeliverer::class);
        $this->injector->getProphecy(OrderDeliverStrategyFactory::class)
            ->create(DeliveryType::ENTERPRISE_DELIVERY())
            ->willReturn($orderDeliverer->reveal());
        $this->injector->getProphecy(EventDispatcher::class)
            ->dispatch(Argument::type(OrderDeliveredEvent::class))->shouldBeCalled();
        $subject->deliver($createSimpleOrder);
    }

    public function testCreateOrderEnterpriseDelivererThrowsException()
    {
        $subject = $this->injector->create(OrderService::class);

        $createSimpleOrder = new CreateOrder(
            new Customer('Elvis Presley', '333 George Street, 2000, Sydney'),
            'personalDeliveryExpress',
            'direct',
            2000
        );
        $createSimpleOrder->setEnterprise(new Enterprise(
            'Bayview Motel',
            'PtyLtd',
            'SN123OK',
            [
                new Director('Michael Jackskon', '242 Bayview, 2434, Sydney'),
                new Director('Freddie Mercury', '132 Coast, 2354, Newcastle')
            ]
        ));
        $this->expectException(InvalidDeliveryException::class);
        $subject->deliver($createSimpleOrder);
    }
}
