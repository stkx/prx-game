<?php

include 'autoload.php';

// A-la Container.
$randomizer = new Domain\Service\BlackHoleRandomizer();
$cf = new Domain\Service\CellFactory();
$adjacentCalculatpr = new Domain\Service\AdjacentCalculator();
$formatter = new Formatter\ConsoleFormatter();
$starter = new Domain\Service\GameStarter($randomizer, $cf, $adjacentCalculatpr);

$board = $starter->start(
    new \Domain\Model\BoardSize(4, 4),
    5
);

echo $board->output($formatter);
$board->handleClick(new \Domain\Model\Coordinate(1, 1));
echo $board->output($formatter);

