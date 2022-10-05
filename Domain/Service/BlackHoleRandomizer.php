<?php


namespace Domain\Service;

use Domain\Model\BoardSize;

final class BlackHoleRandomizer
{
    public function randomizeIndices(BoardSize $boardSize, int $count): array
    {
        $allElements = range(0, $boardSize->getSquare() - 1);
        shuffle($allElements);
        $indices = array_slice($allElements, 0, $count);

        return $indices;;
    }

}