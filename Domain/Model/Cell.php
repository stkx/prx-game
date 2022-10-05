<?php


namespace Domain\Model;

use Domain\Collection\CoordinateCollection;

final class Cell
{

    private bool $isOpen = false;

    public function __construct(
        private bool $isBlack,
        private Coordinate $coordinate,
        private CoordinateCollection $blackAdjacents,
        private CoordinateCollection $nonBlackAdjacents
    ) {
    }

    public function isBlack(): bool
    {
        return $this->isBlack;
    }

    public function getXPos(): int
    {
        return $this->coordinate->getXPos();
    }

    public function getYPos(): int
    {
        return $this->coordinate->getYPos();
    }

    public function getCoordinate(): Coordinate
    {
        return $this->coordinate;
    }

    public function getNonBlackAdjacents(): CoordinateCollection
    {
        return $this->nonBlackAdjacents;
    }

    public function getBlackAdjacents(): CoordinateCollection
    {
        return $this->blackAdjacents;
    }

    public function makeOpen(): void
    {
        $this->isOpen = true;
    }

    public function isOpen(): bool
    {
        return $this->isOpen;
    }


}