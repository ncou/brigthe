<?php
declare(strict_types=1);

use App\Domain\Order\Event\OrderDeliveredEvent;
use App\Domain\Order\EventHandler\OrderDeliveredHandler;
use App\Infrastructure\External\EmailCampaignNotificator;
use DI\ContainerBuilder;
use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');

            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        Manager::class => function (ContainerInterface $c) {
            $fractal = new Manager();
            $fractal->setSerializer(new JsonApiSerializer());
            if (isset($_GET['include'])) {
                $fractal->parseIncludes($_GET['include']);
            }
            return $fractal;
        },
        EventDispatcher::class => function (ContainerInterface $c) {
            $eventDispatcher = new EventDispatcher();
            $eventDispatcher->addListener(
                OrderDeliveredEvent::class, [$c->get(OrderDeliveredHandler::class), 'handleEvent']
            );
            return $eventDispatcher;
        },
        OrderDeliveredHandler::class => function (ContainerInterface $c) {
            return new OrderDeliveredHandler(new EmailCampaignNotificator());
        }
    ]);
};
