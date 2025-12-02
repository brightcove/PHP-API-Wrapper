<?php

declare(strict_types=1);

namespace Brightcove\Type;

use SensitiveParameter;

/**
 * Proxy options DTO.
 */
final readonly class ProxyOptions
{
    /**
     * Initializes a proxy options DTO.
     *
     * @param string $uri
     *   Proxy URI.
     * @param bool $useTunnel
     *   Whether to use tunnel or not.
     * @param int $auth
     *   Auth type.
     * @param string|null $user
     *   Username.
     * @param string|null $password
     *   Password.
     * @param int $port
     *   Proxy port.
     * @param int $type
     *   Proxy type.
     */
    public function __construct(
        private string $uri,
        private bool $useTunnel = false,
        private int $auth = \CURLAUTH_NONE,
        private ?string $user = null,
        #[SensitiveParameter]
        private ?string $password = null,
        private int $port = 0,
        private int $type = \CURLPROXY_HTTP,
    ) {
    }

    /**
     * Maps properties with CURL options.
     *
     * @return array
     *   CURL options mapping.
     */
    public function toArray(): array
    {
        return [
            \CURLOPT_PROXY => $this->uri,
            \CURLOPT_HTTPPROXYTUNNEL => $this->useTunnel,
            \CURLOPT_PROXYAUTH => $this->auth,
            \CURLOPT_PROXYUSERPWD => "{$this->user}:{$this->password}",
            \CURLOPT_PROXYPORT => $this->port,
            \CURLOPT_PROXYTYPE => $this->type,
        ];
    }
}
