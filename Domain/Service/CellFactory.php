<?php


namespace Domain\Service;

use Domain\Collection\CoordinateCollection;
use Domain\Model\Cell;
use Domain\Model\Coordinate;

final class CellFactory
{

    public function create(
        bool $isBlack,
        Coordinate $coordinate,
        CoordinateCollection $blackAdjacents,
        CoordinateCollection $nonBlackAdjacents
    ): Cell {
        return new Cell($isBlack, $coordinate, $blackAdjacents, $nonBlackAdjacents);
    }
}