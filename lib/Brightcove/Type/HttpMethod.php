<?php

declare(strict_types=1);

namespace Brightcove\Type;

/**
 * HTTP methods.
 */
enum HttpMethod: string
{
    case Get = 'GET';
    case Post = 'POST';
    case Put = 'PUT';
    case Delete = 'DELETE';
    case Patch = 'PATCH';
    case Options = 'OPTIONS';
    case Head = 'HEAD';
    case Trace = 'TRACE';
    case Connect = 'CONNECT';
}
