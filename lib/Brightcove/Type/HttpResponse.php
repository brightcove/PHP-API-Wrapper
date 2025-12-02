<?php

declare(strict_types=1);

namespace Brightcove\Type;

/**
 * HTTP response.
 */
enum HttpResponse: int
{
    /**
     * HTTP success.
     */
    case Ok = 200;

    /**
     * HTTP not found.
     */
    case NotFound = 404;
}
