<?php

declare(strict_types=1);

namespace Brightcove\API;

use Brightcove\API\Request\IngestRequest;
use Brightcove\API\Response\IngestResponse;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Interface for Dynamic Ingest API.
 *
 * @see https://apis.support.brightcove.com/dynamic-ingest/references/reference.html
 */
interface DiInterface
{
    /**
     * Creates an ingest.
     *
     * @param string $video_id
     *   Video ID.
     * @param IngestRequest $request
     *   Ingest request.
     *
     * @return IngestResponse
     *   Ingest response.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function createIngest(string $video_id, IngestRequest $request): IngestResponse;
}
