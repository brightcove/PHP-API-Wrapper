<?php

declare(strict_types=1);

namespace Brightcove\API;

use Brightcove\API\Exception\ApiException;
use Brightcove\Item\IngestProfiles\Ingestion;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Ingestion profiles API interface.
 *
 * @see https://apis.support.brightcove.com/ingest-profiles/references/reference.html
 */
interface IngestProfilesInterface
{
    /**
     * Get ingestion profiles.
     *
     * @param string $account_id
     *   Account ID.
     *
     * @return Ingestion[]
     *   List of ingestion profiles.
     *
     * @throws ApiException
     *   If the request is failed.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function getProfiles(string $account_id): array;
}
