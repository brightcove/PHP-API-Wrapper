<?php

declare(strict_types=1);

namespace Brightcove\Type;

/**
 * Sort type interface.
 */
interface SortInterface
{

    /**
     * Returns the field that needs to be sorted.
     */
    public function __toString(): string;
}
