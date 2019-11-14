<?php
declare(strict_types=1);

namespace App\Application\Actions\Order\Command;

class Enterprise
{
    /** @var string */
    private $name;
    /** @var string */
    private $type;
    /** @var string */
    private $abn;
    /** @var Director[] */
    private $directors;

    public function __construct(string $name, string $type, string $abn, array $directors)
    {
        $this->name = $name;
        $this->type = $type;
        $this->abn = $abn;
        $this->directors = $directors;
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
    public function getAbn(): string
    {
        return $this->abn;
    }

    /**
     * @return Director[]
     */
    public function getDirectors(): array
    {
        return $this->directors;
    }

}
