<?php
declare(strict_types=1);

namespace App\Domain\Enterprise;

class NoEnterprise extends Enterprise
{
    public function __construct()
    {
        parent::__construct('', '','', []);
    }
}
