<?php
declare(strict_types=1);

namespace App\Domain\Enterprise;

class Enterprise
{
    /** @var string */
    private $name;
    /** @var string */
    private $type;
    /** @var string */
    private $abn;
    /** @var array */
    private $directors;

    public function __construct(string $name, string $type, string $abn, array $directors)
    {
        $this->name = $name;
        $this->type = $type;
        $this->abn = $abn;
        $this->directors = $directors;
    }
}
