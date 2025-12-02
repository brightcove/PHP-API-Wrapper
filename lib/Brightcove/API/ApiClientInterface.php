<?php

namespace Brightcove\API;

use Brightcove\Item\ObjectInterface;
use Brightcove\Type\ApiType;
use Brightcove\Type\HttpMethod;
use Http\Promise\Promise;
use Psr\Http\Client\ClientExceptionInterface;

interface ApiClientInterface
{
    /**
     * Sends an authorized request to a Brightcove API endpoint.
     *
     * @param HttpMethod $method
     *   HTTP method.
     * @param string $api_version
     *   API version.
     * @param ApiType $api_type
     *   API type, e.g. cms, di etc.
     * @param string $account_id
     *   Brightcove account ID.
     * @param string $endpoint
     *   API endpoint.
     * @param string|null $result
     *   NULL to return the unmarshalled JSON, or a class name to deserialize into.
     *   This class must implement ObjectInterface.
     * @param bool $is_array
     *   TRUE if the result is an array of objects. Not used when $result is NULL.
     * @param ObjectInterface|null $post
     *   An ObjectInterface to post.
     *
     * @return ObjectInterface|ObjectInterface[]|null
     *   The endpoint result.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     *
     * @internal
     */
    public function sendRequest(
        HttpMethod $method,
        string $api_version,
        ApiType $api_type,
        string $account_id,
        string $endpoint,
        ?string $result,
        bool $is_array = false,
        ?ObjectInterface $post = null,
    ): ObjectInterface|array|null;

    /**
     * Sends an async request.
     *
     * @param HttpMethod $method
     *    HTTP method.
     * @param string $api_version
     *    API version.
     * @param ApiType $api_type
     *    API type.
     * @param string $account_id
     *    Account ID.
     * @param string $endpoint
     *    Request endpoint (without the base URL).
     * @param ObjectInterface|null $post
     *
     * @return Promise
     *   (Un)fulfilled response promise.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     *
     * @internal
     */
    public function sendAsyncRequest(
        HttpMethod $method,
        string $api_version,
        ApiType $api_type,
        string $account_id,
        string $endpoint,
        ?ObjectInterface $post = null,
    ): Promise;

    /**
     * Sets consumer name and version for the User-Agent header.
     *
     * @param string $consumer
     *   Consumer name and version.
     */
    public static function setConsumer(string $consumer): void;
}
