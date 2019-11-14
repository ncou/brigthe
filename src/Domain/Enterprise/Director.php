<?php
declare(strict_types=1);

namespace App\Domain\Enterprise;

class Director
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
}
