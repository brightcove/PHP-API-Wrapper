<?php

declare(strict_types=1);

namespace Brightcove\Type;

use SensitiveParameter;

/**
 * Access token DTO.
 */
final readonly class AccessToken
{
    /**
     * Initializes an access token DTO.
     *
     * @param string $accessToken
     *   Access token.
     * @param int $expiresIn
     *   Expires in; seconds.
     * @param string $tokenType
     *   Token type; Bearer.
     */
    public function __construct(
        #[SensitiveParameter]
        public string $accessToken,
        public int $expiresIn,
        public string $tokenType,
    )
    {}

    /**
     * Creates a new instance from a response object.
     *
     * @param object $object
     *   Response object.
     * @return self
     *   A new access token instance.
     */
    public static function fromObject(object $object): self
    {
        return new self(
            $object->access_token,
            $object->expires_in,
            $object->token_type
        );
    }
}
