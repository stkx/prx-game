<?php

namespace Domain\Model;

final class BoardSize
{

    public function __construct(private int $width, private int $height)
    {
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getSquare(): int
    {
        return $this->width * $this->height;
    }
}