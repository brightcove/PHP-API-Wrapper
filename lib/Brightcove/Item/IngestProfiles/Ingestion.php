<?php

declare(strict_types=1);

namespace Brightcove\Item\IngestProfiles;

use Brightcove\Item\ObjectBase;

/**
 * In-Page Experience entity.
 */
final class Ingestion extends ObjectBase {

    public function __construct(
        public string $id,
        public string $name,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'name');
    }

}
