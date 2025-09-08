<?php

declare(strict_types=1);

namespace Brightcove\Type;

/**
 * API type list.
 */
enum ApiType: string {

    /**
     * CMS API.
     */
    case CMS = 'cms';

    /**
     * Dynamic ingestion API.
     */
    case DynamicIngest = 'ingest';

    /**
     * In-page experience API.
     */
    case InPageExperience = 'experiences';

    /**
     * Ingest profiles API.
     */
    case IngestProfiles = 'ingestion';

    /**
     * Players API.
     */
    case Players = 'players';

}
