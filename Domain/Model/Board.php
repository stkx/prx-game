<?php

namespace Domain\Model;

use Domain\Collection\CellCollection;
use InvalidArgumentException;
use Formatter\FormatterContract;

final class Board
{

    public function __construct(
        private BoardSize $boardSize,
        private int $countHoles,
        private array $map,
        private CellCollection $cells
    ) {
    }


    public function output(FormatterContract $formatter): string
    {
       return $formatter->getResults($this->cells);

    }

    public function handleClick(Coordinate $clickCoordinate): void
    {
        foreach ($this->cells->all() as $cell) {
            if (! $cell->getCoordinate()->isEqual($clickCoordinate)) {
                continue;
            }

            $this->openRecursive($cell);
        }
    }


    private function openRecursive(Cell $openedCell): void
    {
        if ($openedCell->isOpen() || $openedCell->isBlack()) {
            return;
        }
        $openedCell->makeOpen();

        foreach ($openedCell->getNonBlackAdjacents()->all() as $coordinate) {
            foreach ($this->cells->all() as $adjacentCell) {
                if ($adjacentCell->getCoordinate()->isEqual($coordinate)) {
                    $this->openRecursive($adjacentCell);
                }
            }
        }
    }

}