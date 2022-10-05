<?php

namespace Formatter;

use Domain\Collection\CellCollection;

interface FormatterContract
{

    public function getResults(CellCollection $cellCollection): string;
}