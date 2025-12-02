<?php

declare(strict_types=1);

namespace Brightcove\API\Response;

use Brightcove\Item\ObjectBase;

/**
 * Class IngestResponse
 *
 * @package Brightcove\API\Response
 * @api
 */
class IngestResponse extends ObjectBase
{
    protected ?string $id;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'id');
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;
        $this->fieldChanged('id');
        return $this;
    }
}
