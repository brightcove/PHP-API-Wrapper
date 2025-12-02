<?php

declare(strict_types=1);

namespace Brightcove\Item\IngestProfiles;

use Brightcove\Item\ObjectBase;

/**
 * Ingestion profile entity.
 */
class Ingestion extends ObjectBase
{
    protected ?string $id = null;
    protected ?string $name = null;

    /**
     * {@inheritdoc}
     */
    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'name');
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
        $this->fieldChanged('id');
    }

    public function setName(string $name): void
    {
        $this->name = $name;
        $this->fieldChanged('name');
    }
}
