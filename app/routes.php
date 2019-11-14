<?php
declare(strict_types=1);

use App\Application\Actions\Order\ProcessOrdersAction;
use Slim\App;

return function (App $app) {
    $app->post('/api/v1/orders', ProcessOrdersAction::class);
};
