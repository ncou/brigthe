<?php
declare(strict_types=1);

namespace App\Domain\Order;

class Customer
{
    /** @var string */
    private $name;
    /** @var string */
    private $address;

    public function __construct(string $name, string $address)
    {
        $this->name = $name;
        $this->address = $address;
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
    public function getAddress(): string
    {
        return $this->address;
    }
}
