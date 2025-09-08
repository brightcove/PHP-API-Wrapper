<?php

namespace Brightcove\API;

use Brightcove\{
    Constants,
    Item\ObjectInterface,
    Storage\MemoryStorage,
    Storage\StorageInterface,
    Type\ApiType,
    Type\HttpMethod,
};
use Brightcove\Http\Message\Authentication\OAuth2;
use Http\Client\Common\{
    Plugin,
    Plugin\AuthenticationPlugin,
    Plugin\ErrorPlugin,
    Plugin\HeaderDefaultsPlugin,
    Plugin\RetryPlugin,
    PluginClient,
};
use Http\Client\HttpAsyncClient;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Promise\Promise;
use Psr\Http\{Client\ClientExceptionInterface,
  Client\ClientInterface,
  Message\RequestFactoryInterface,
  Message\RequestInterface,
  Message\ResponseInterface,
  Message\StreamFactoryInterface,
  Message\StreamInterface};
use SensitiveParameter;

/**
 * API client for Brightcove APIs.
 */
final class ApiClient implements ApiClientInterface
{
    /**
     * HTTP client.
     */
    private readonly PluginClient $client;

    /**
     * Consumer name and version.
     */
    private static ?string $consumer = null;

    /**
     * Initializes a pluggable HTTP client.
     *
     * @param HttpAsyncClient|ClientInterface $client
     *   HTTP client.
     * @param string $clientId
     *   Client ID.
     * @param string $clientSecret
     *   Client Secret.
     * @param StorageInterface $storage
     *   Storage.
     * @param RequestFactoryInterface|null $requestFactory
     *   PSR-17 request factory.
     * @param StreamFactoryInterface|null $streamFactory
     *   PSR-17 stream factory.
     * @param Plugin[] $additionalPlugins
     *   Additional plugins.
     * @param array{'max_restarts'?: int} $options
     *   Options.
     */
    public function __construct(
        HttpAsyncClient|ClientInterface $client,
        string $clientId,
        #[SensitiveParameter]
        string $clientSecret,
        StorageInterface $storage = new MemoryStorage(),
        private ?RequestFactoryInterface $requestFactory = null,
        private ?StreamFactoryInterface $streamFactory = null,
        array $additionalPlugins = [],
        array $options = [],
    ) {
        // Find a request factory if not set.
        if ($requestFactory === null) {
            $this->requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        }

        if ($streamFactory === null) {
            $this->streamFactory = Psr17FactoryDiscovery::findStreamFactory();
        }

        // Initializes pluggable client.
        $this->client = new PluginClient(
            $client, [
                new AuthenticationPlugin(
                    new OAuth2($client, $clientId, $clientSecret, $storage, $this->requestFactory, $this->streamFactory),
                ),
                new ErrorPlugin(),
                new HeaderDefaultsPlugin([
                    'Content-Type' => 'application/json',
                    'User-Agent' => self::getUserAgent(),
                ]),
                new RetryPlugin([
                    'exception_delay' => [self::class, 'exceptionDelay'],
                    'retries' => 10,
                ]),
            ] + $additionalPlugins, $options,
        );
    }

    /**
     * Exception delay callback for the client's retry plugin.
     *
     * @param RequestInterface $request
     *   Request.
     * @param ClientExceptionInterface $client_exception
     *   Client exception.
     * @param int $retries
     *   Number of retries.
     *
     * @return int
     *   Sleep time in microseconds.
     *
     * @internal
     */
    public static function exceptionDelay(RequestInterface $request, ClientExceptionInterface $client_exception, int $retries,): int
    {
        // Wait explicitly 2 seconds to be on the safe side if we hit too many requests.
        // @see https://support.brightcove.com/overview-cms-api.html#Rate_limiting
        if ($client_exception->getCode() === 429) {
            return 2000000;
        }

        static $sleep_time = [0, 100000];
        $sleep_time = [$sleep_time[1], $sleep_time[0] + $sleep_time[1]];
        return $sleep_time[1];
    }

    /**
     * Collect promise results.
     *
     * @param Promise[] $promises
     *   List of promises.
     *
     * @return ResponseInterface[]
     *   Promise results.
     */
    public function collectPromiseResults(array $promises): array
    {
        $responses = [];
        do {
            $finished = true;
            foreach ($promises as $promise) {
                if ($promise->getState() === Promise::PENDING) {
                    $finished = false;
                    continue;
                }
                $responses[] = $promise->wait();
            }
            microtime(100);
        } while(!$finished);
        return $responses;
    }

    /**
     * {@inheritDoc}
     */
    public static function setConsumer(string $consumer): void {
        self::$consumer = $consumer;
    }

    /**
     * {@inheritDoc}
     */
    public function sendRequest(HttpMethod $method, string $api_version, ApiType $api_type, string $account_id, string $endpoint, ?string $result, bool $is_array = false, ?ObjectInterface $post = null,): ObjectInterface|array|null
    {
        $request = $this->requestFactory->createRequest(
            $method->value,
            $this->getApiBaseUrl($api_type, $api_version, $account_id, $endpoint),
        );

        $body = $this->prepareBody($method, $post);
        if ($body !== null) {
            $request->withBody($body);
        }

        $response = $this->client->sendRequest($request);
        $json = json_decode($response->getBody()->getContents(), true);

        if ($result === null) {
            return $json;
        } elseif ($is_array) {
            $list = [];
            foreach ($json as $item) {
                $list[] = call_user_func([$result, 'fromJSON'], $item);
            }
            return $list;
        }

        return call_user_func([$result, 'fromJSON'], $json);
    }

    /**
     * {@inheritDoc}
     */
    public function sendAsyncRequest(HttpMethod $method, string $api_version, ApiType $api_type, string $account_id, string $endpoint, ?ObjectInterface $post = null,): Promise
    {
        $request = $this->requestFactory->createRequest(
            $method->value,
            $this->getApiBaseUrl($api_type, $api_version, $account_id, $endpoint),
        );

        $body = $this->prepareBody($method, $post);
        if ($body !== null) {
          $request->withBody($body);
        }

        return $this->client->sendAsyncRequest($request);
    }

    /**
     * Gets the User-Agent string.
     *
     * @return string
     *   User-Agent string.
     */
    private function getUserAgent(): string
    {
        return sprintf('PHP-API-Wrapper/%s (%s;%s curl/%s)%s',
            Constants::VERSION,
            $_SERVER['HTTP_HOST'] ?: gethostname(),
            isset($_SERVER['SERVER_SOFTWARE']) ? " {$_SERVER['SERVER_SOFTWARE']}": '',
            curl_version()['version'],
            self::$consumer !== null ? ' ' . self::$consumer : '',
        );
    }

    /**
     * Prepares the body for the request.
     *
     * @param HttpMethod $method
     *   HTTP method.
     * @param ObjectInterface|null $post
     *   POST object.
     *
     * @return StreamInterface|null
     *   Prepared body.
     */
    private function prepareBody(HttpMethod $method, ?ObjectInterface $post = null): ?StreamInterface
    {
        $body = null;
        if ($post !== null) {
            if ($method === HttpMethod::Patch) {
                $body = $post->patchJSON();
            } else {
                $body = $post->postJSON();
            }
            $body = json_encode($body) ?: null;
        }

        if ($body !== null) {
          return $this->streamFactory->createStream($body);
        }

        return null;
    }

    /**
     * Gets API base URL.
     *
     * @param ApiType $api_type
     *   API type.
     * @param string $api_version
     *   API version.
     * @param string $account_id
     *   Account ID.
     * @param string $endpoint
     *   Endpoint path.
     *
     * @return string
     *   The constructed API base URL.
     */
    private function getApiBaseUrl(ApiType $api_type, string $api_version, string $account_id, string $endpoint): string
    {
        return sprintf('https://%s.api.brightcove.com/v%s/accounts/%s%s', $api_type->value, $api_version, $account_id, $endpoint);
    }
}
