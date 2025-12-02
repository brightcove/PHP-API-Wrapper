<?php

namespace Brightcove\API;

use Brightcove\API\Request\IngestRequest;
use Brightcove\API\Response\IngestResponse;
use Brightcove\Item\ObjectInterface;
use Brightcove\Type\ApiType;
use Brightcove\Type\HttpMethod;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Dynamic Ingest API.
 *
 * @package Brightcove\API
 * @api
 */
class DI extends API implements DiInterface
{
    /**
     * {@inheritDoc}
     */
    public function createIngest(string $video_id, IngestRequest $request): IngestResponse
    {
        return $this->sendRequest(
            HttpMethod::Post,
            "/videos/{$video_id}/ingest-requests",
            IngestResponse::class,
            false,
            $request,
        );
    }

    /**
     * Sends request using the DI API.
     *
     * @template Response
     *
     * @param HttpMethod $method
     *   HTTP method.
     * @param $endpoint
     *   API endpoint.
     * @param Response|class-string $result
     *
     * @param bool $is_array
     *
     * @param $post
     *
     * @return Response|Response[]|null
     *   Response object.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    protected function sendRequest(
        HttpMethod $method,
        string $endpoint,
        mixed $result,
        bool $is_array = false,
        $post = null,
    ): ObjectInterface|array|null {
        return $this->client->sendRequest(
            $method,
            self::API_VERSION,
            ApiType::DynamicIngest,
            $this->account,
            $endpoint,
            $result,
            $is_array,
            $post,
        );
    }
}
