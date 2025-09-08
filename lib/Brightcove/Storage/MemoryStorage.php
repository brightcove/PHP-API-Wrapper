<?php

declare(strict_types=1);

namespace Brightcove\Storage;

use Brightcove\Type\AccessToken;

/**
 * Storage in memory.
 *
 * @todo Inject a time service.
 */
final class MemoryStorage implements StorageInterface {

    /**
     * Access token.
     */
    private ?AccessToken $accessToken = NULL;

    /**
     * Expiration time of the token.
     */
    private int $accessTokenExpiresAt = 0;

    /**
     * {@inheritdoc}
     */
    public function getAccessToken(): ?AccessToken
    {
        return $this->accessToken;
    }

    /**
     * {@inheritdoc}
     */
    public function isAccessTokenExpired(): bool
    {
        return $this->accessTokenExpiresAt < time();
    }

    /**
     * {@inheritdoc}
     */
    public function storeAccessToken(AccessToken $accessToken): void
    {
        $this->accessToken = $accessToken;
        $this->accessTokenExpiresAt = time() + $accessToken->expiresIn;
    }
}
