<?php

namespace PHPMaker2025\project1;

/**
 * Crosstab column class
 */
class CrosstabColumn
{

    public function __construct(
        public string $Caption,
        public mixed $Value,
        public bool $Visible = true,
    ) {
    }
}
