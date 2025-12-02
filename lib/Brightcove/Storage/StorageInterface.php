<?php

declare(strict_types=1);

namespace Brightcove\Storage;

use Brightcove\Type\AccessToken;

interface StorageInterface
{
    /**
     * Gets an existing access token.
     *
     * @return AccessToken|null
     *   Access token.
     */
    public function getAccessToken(): ?AccessToken;

    /**
     * Gets if the access token expired or not.
     *
     * @return bool
     *   True if expired, false otherwise.
     */
    public function isAccessTokenExpired(): bool;

    /**
     * Stores the access token.
     *
     * @param AccessToken $accessToken
     *   Access token to store.
     */
    public function storeAccessToken(AccessToken $accessToken): void;
}
