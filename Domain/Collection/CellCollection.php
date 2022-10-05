<?php

namespace Domain\Collection;

use Domain\Model\Cell;

final class CellCollection extends Collection
{
    private array $data;

    public function __construct(Cell ...$cell)
    {
        $this->data = $cell;
    }

    public function all(): array
    {
        return $this->data;
    }
}