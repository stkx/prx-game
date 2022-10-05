<?php

namespace Formatter;

use Domain\Collection\CellCollection;
use Domain\Model\Board;

final class ConsoleFormatter implements FormatterContract
{

    public function getResults(CellCollection $cellCollection): string
    {
        $str = "\n-----------------\n";

        $cells = $cellCollection->all();
        foreach ($cells as $i => $cell) {
            if ($cell->isBlack()) {
                $str .= 'H';
            } else {
                if ($cell->isOpen()) {
                    $str .= sprintf('X');
                } else {
                    $str .= sprintf('%s', $cell->getBlackAdjacents()->count());
                }
            }

            if (isset($cells[$i + 1]) && ($cells[$i + 1]->getYPos() > $cell->getYPos())) {
                $str .= "\n";
            }
        }
        $str .= "\n-----------------\n";

        return $str;
    }
}