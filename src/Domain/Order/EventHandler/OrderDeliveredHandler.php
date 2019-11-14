<?php
declare(strict_types=1);

namespace App\Domain\Order\EventHandler;

use App\Domain\Order\Event\OrderDeliveredEvent;
use App\Infrastructure\External\EmailCampaignNotificator;

class OrderDeliveredHandler
{
    /** @var EmailCampaignNotificator */
    private $notificator;

    public function __construct(EmailCampaignNotificator $notificator)
    {
        $this->notificator = $notificator;
    }

    public function handleEvent(OrderDeliveredEvent $event) {
        if ($event->getOrder()->isFromCampaign()) {
            $this->notificator->notify();
        }
    }
}
