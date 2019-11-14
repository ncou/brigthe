<?php
declare(strict_types=1);

namespace App\Domain\Enterprise;

interface EnterpriseValidatorInterface
{
    public function validate(Enterprise $enterprise);
}
