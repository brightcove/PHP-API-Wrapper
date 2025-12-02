<?php

declare(strict_types=1);

namespace Brightcove\API\Exception;

use Exception;

/**
 * Generic API exception.
 *
 * @package Brightcove\API\Exception
 * @api
 */
class ApiException extends Exception
{
    /**
     * Gets the response body.
     */
    public function getResponseBody(): string
    {
        return $this->responseBody;
    }

    /**
     * @param string $responseBody
     *
     * @return ApiException
     */
    public function setResponseBody(string $responseBody): self
    {
        $this->responseBody = $responseBody;
        return $this;
    }

    /**
     * Initializes an API exception.
     *
     * @param string $message
     *   Message.
     * @param int $code
     *   Code.
     * @param Exception|null $previous
     *   Previous exception.
     * @param string $responseBody
     *   Response body.
     */
    public function __construct(
        string $message = '',
        int $code = 0,
        Exception $previous = null,
        protected string $responseBody = '',
    ) {
        parent::__construct($message, $code, $previous);
    }
}
