<?php

namespace Domain\Model;

final class Coordinate
{

    public function __construct(private int $xPos, private int $yPos)
    {
    }

    public function getXPos(): int
    {
        return $this->xPos;
    }

    public function getYPos(): int
    {
        return $this->yPos;
    }

    public function __toString(): string
    {
        return sprintf('%s:%s', $this->xPos, $this->yPos);
    }

    public function isEqual(Coordinate $coordinate): bool
    {
        return $this->xPos == $coordinate->xPos && $this->yPos == $coordinate->yPos;
    }

}