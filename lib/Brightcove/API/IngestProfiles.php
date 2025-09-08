<?php

declare(strict_types=1);

namespace Brightcove\API;

use Brightcove\Item\IngestProfiles\Ingestion;
use Brightcove\Type\ApiType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Ingest Profiles API.
 */
final class IngestProfiles extends ApiBase implements IngestProfilesInterface {

    /**
     * {@inheritdoc}
     */
    public function getProfiles(string $account_id): ?array {
        return $this->client->sendRequest(Request::METHOD_GET, self::API_VERSION, ApiType::IngestProfiles, $account_id, '/profiles', Ingestion::class, true);
    }

}
