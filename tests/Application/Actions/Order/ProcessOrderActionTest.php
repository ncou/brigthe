<?php
declare(strict_types=1);

namespace Tests\Application\Actions\Order;

use App\Application\Actions\ActionPayload;
use App\Domain\Order\OrderService;
use DI\Container;
use Tests\TestCase;

class ProcessOrderActionTest extends TestCase
{
    public function testActionFails()
    {
        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        $orderService = $this->prophesize(OrderService::class);
        $container->set(OrderService::class, $orderService->reveal());

        $request = $this->createRequest('POST', '/api/v1/orders');
        $request->withBody([]);
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = new ActionPayload(200, ['status' => 'ok']);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);

    }
}
