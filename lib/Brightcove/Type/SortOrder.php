<?php

declare(strict_types=1);

namespace Brightcove\Type;

/**
 * Sorting order options.
 */
enum SortOrder: string
{
    case default = '';
    case reverse = '-';
}
