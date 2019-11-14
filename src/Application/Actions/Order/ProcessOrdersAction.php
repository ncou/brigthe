<?php
declare(strict_types=1);

namespace App\Application\Actions\Order;

use App\Application\Actions\Action;
use App\Application\Actions\Order\Command\Campaign;
use App\Application\Actions\Order\Command\CreateOrder;
use App\Application\Actions\Order\Command\Customer;
use App\Application\Actions\Order\Command\Director;
use App\Application\Actions\Order\Command\Enterprise;
use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Domain\Order\Exception\InvalidDeliveryException;
use App\Domain\Order\Exception\InvalidOrderException;
use App\Domain\Order\OrderService;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;

class ProcessOrdersAction extends Action
{
    /** @var OrderService */
    private $orderService;

    public function __construct(LoggerInterface $logger, OrderService $orderService)
    {
        parent::__construct($logger);
        $this->orderService = $orderService;
    }

    /**
     * @return ResponseInterface
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    protected function action(): ResponseInterface
    {
        $orders = json_decode((string)$this->request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        foreach ($orders as $orderData) {
            $createOrder = new CreateOrder(
                new Customer($orderData['customer']['name'], $orderData['customer']['address']),
                $orderData['deliveryType'],
                $orderData['source'],
                $orderData['weight']
            );
            if (isset($orderData['campaign'])) {
                $createOrder->setCampaign(
                    new Campaign(
                        $orderData['campaign']['name'],
                        $orderData['campaign']['type'],
                        $orderData['campaign']['ad'])
                );
            }
            if (isset($orderData['enterprise'])) {
                $createOrder->setEnterprise(
                    new Enterprise(
                        $orderData['enterprise']['name'],
                        $orderData['enterprise']['type'],
                        $orderData['enterprise']['abn'],
                        array_map(function (array $data) {
                            return new Director($data['name'], $data['address']);
                        }, $orderData['enterprise']['directors'])
                    )
                );
            }
            try {
                $this->orderService->deliver($createOrder);
            } catch (InvalidOrderException $e) {
                return $this->respondWithData(['result' => 'The request could not validate enterprise'])->withStatus(400);
            } catch (InvalidDeliveryException $e) {
                return $this->respondWithData(['result' => 'The request was invalid'])->withStatus(400);
            }
        }
        return $this->respondWithData(['result' => 'ok']);
    }
}
