<?php

declare(strict_types=1);

namespace Brightcove\Type;

/**
 * Sort type interface.
 */
interface SortInterface
{
    /**
     * Default sort order.
     */
    public const ORDER_DEFAULT = '';

    /**
     * Reverse sort order.
     */
    public const ORDER_REVERSE = '-';

    /**
     * Returns the field that needs to be sorted.
     */
    public function __toString(): string;
}
