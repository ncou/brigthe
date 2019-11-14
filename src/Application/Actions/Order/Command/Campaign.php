<?php
declare(strict_types=1);

namespace App\Application\Actions\Order\Command;

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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getAd(): string
    {
        return $this->ad;
    }
}
