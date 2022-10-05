<?php


namespace Domain\Service;

use Domain\Collection\CellCollection;
use Domain\Model\Board;
use Domain\Model\BoardSize;
use Domain\Model\Coordinate;

final class GameStarter
{

    public function __construct(
        private BlackHoleRandomizer $randomizer,
        private CellFactory $cellFactory,
        private AdjacentCalculator $adjacentCalculator
    ) {
    }


    public function start(BoardSize $boardSize, int $holesCount): Board
    {
        $cellMap = $this->buildCellMap($boardSize, $holesCount);
        $cells = $this->generateCells($cellMap);

        return new Board($boardSize, $holesCount, $cellMap, $cells);
    }

    private function buildCellMap(BoardSize $boardSize, int $holesCount): array
    {
        $iteratedCell = 0;
        $cellMap = [];

        $indices = $this->randomizer->randomizeIndices($boardSize, $holesCount);

        foreach (range(1, $boardSize->getHeight()) as $currentYPos) {
            foreach (range(1, $boardSize->getWidth()) as $currentXPos) {
                $isBlackCell = in_array($iteratedCell, $indices);
                $iteratedCell++;
                $coordinateIndex = (string)(new Coordinate($currentXPos, $currentYPos));
                $cellMap[$coordinateIndex] = $isBlackCell;
            }
        }

        return $cellMap;
    }

    private function generateCells(array $cellMap): CellCollection
    {
        $cells = [];

        foreach ($cellMap as $cellCoordinate => $isBlack) {
            list($xPos, $yPos) = explode(':', $cellCoordinate);

            $adjacents = $this->adjacentCalculator->getAdjacentsCoordinates(
                new Coordinate($xPos, $yPos),
            );

            $existingAdjacents = $adjacents->filter(
                function (Coordinate $adjacent) use ($cellMap) {
                    $coordinateIndex = (string)$adjacent;
                    return isset($cellMap[$coordinateIndex]);
                }
            );

            $blackAdjacents = $existingAdjacents->filter(
                function (Coordinate $adjacent) use ($cellMap) {
                    $coordinateIndex = (string)$adjacent;
                    return ! ! $cellMap[$coordinateIndex];
                }
            );

            $cell = $this->cellFactory->create(
                $isBlack,
                new Coordinate($xPos, $yPos),
                $blackAdjacents,
                $existingAdjacents->diff($blackAdjacents)
            );
            $cells[] = $cell;
        }

        return new CellCollection(...$cells);
    }
}