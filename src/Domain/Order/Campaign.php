<?php
declare(strict_types=1);

namespace App\Domain\Order;

class Campaign
{
    /** @var string */
    private $name;
    /** @var string */
    private $type;
    /** @var string */
    private $ad;

    public function __construct(string $name, string $type, string $ad)
    {
        $this->name = $name;
        $this->type = $type;
        $this->ad = $ad;
    }
}
