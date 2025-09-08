<?php

declare(strict_types=1);

namespace Brightcove\Http\Message\Authentication;

use Brightcove\Storage\StorageInterface;
use Brightcove\Type\AccessToken;
use Brightcove\Type\HttpMethod;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\RetryPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpAsyncClient;
use Http\Message\Authentication;
use Http\Message\Authentication\BasicAuth;
use Http\Message\Authentication\Bearer;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Authenticate a PSR-7 Request via OAuth2.
 */
final readonly class OAuth2 implements Authentication
{

    /**
     * Initializes an OAuth2 authentication.
     *
     * @param HttpAsyncClient|ClientInterface $client
     *   HTTP client.
     * @param string $clientId
     *   Client ID.
     * @param string $clientSecret
     *   Client secret.
     * @param StorageInterface $storage
     *   Storage.
     */
    public function __construct(
        private HttpAsyncClient|ClientInterface $client,
        private string $clientId,
        #[\SensitiveParameter]
        private string $clientSecret,
        private StorageInterface $storage,
        private RequestFactoryInterface $requestFactory,
        private StreamFactoryInterface $streamFactory,
    )
    {}

    /**
     * {@inheritdoc}
     */
    public function authenticate(RequestInterface $request): RequestInterface
    {
        return (new Bearer($this->getAccessToken()->accessToken))->authenticate($request);
    }

    /**
     * Gets the access token.
     *
     * @throws JsonException
     *   If the JSON is invalid.
     * @throws ClientExceptionInterface
     *   If the request failed.
     */
    public function getAccessToken(): AccessToken
    {
        $access_token = $this->storage->getAccessToken();

        // Acquire access token if necessary.
        if ($access_token === NULL || $this->storage->isAccessTokenExpired()) {
            $client = new PluginClient($this->client, [
                new AuthenticationPlugin(new BasicAuth($this->clientId, $this->clientSecret)),
                new HeaderDefaultsPlugin([
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ]),
                new RetryPlugin([
                    'retries' => 3,
                ])
            ]);

            $response = $client->sendRequest($this->requestFactory->createRequest(HttpMethod::Post->value, 'https://oauth.brightcove.com/v3/access_token')
                ->withBody($this->streamFactory->createStream('grant_type=client_credentials'))
            );

            $access_token = AccessToken::fromObject(json_decode($response->getBody()->getContents(), flags: JSON_THROW_ON_ERROR));
            $this->storage->storeAccessToken($access_token);
        }

        return $access_token;
    }
}
