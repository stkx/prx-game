<?php

namespace Domain\Collection;

use Domain\Model\Coordinate;

final class CoordinateCollection extends Collection
{
    private array $data;

    public function __construct(Coordinate ...$cell)
    {
        $this->data = $cell;
    }

    public function all(): array
    {
        return $this->data;
    }

}