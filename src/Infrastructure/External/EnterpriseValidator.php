<?php
declare(strict_types=1);

namespace App\Infrastructure\External;

use App\Domain\Enterprise\Enterprise;
use App\Domain\Enterprise\EnterpriseValidatorInterface;

class EnterpriseValidator implements EnterpriseValidatorInterface
{

    public function validate(Enterprise $enterprise): bool
    {
        return true;
    }
}
