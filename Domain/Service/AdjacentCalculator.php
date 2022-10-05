<?php

namespace Domain\Service;

use Domain\Collection\CoordinateCollection;
use Domain\Model\Coordinate;

final class AdjacentCalculator
{

    public function getAdjacentsCoordinates(Coordinate $coordinate): CoordinateCollection
    {
        $xPos = $coordinate->getXPos();
        $yPos = $coordinate->getYPos();

        return new CoordinateCollection(
            new Coordinate($xPos + 1, $yPos), // Right
            new Coordinate($xPos - 1, $yPos), // Left
            new Coordinate($xPos, $yPos + 1), // Up
            new Coordinate($xPos, $yPos - 1), // Down
            new Coordinate($xPos + 1, $yPos - 1), // UpRight
            new Coordinate($xPos - 1, $yPos - 1), // UpLeft
            new Coordinate($xPos + 1, $yPos + 1), // DownRight
            new Coordinate($xPos - 1, $yPos + 1), // DownLeft
        );
    }
}