<?php

declare(strict_types=1);

namespace Brightcove\API\Request;

use Brightcove\Item\ObjectBase;

/**
 * Class IngestRequestMaster
 *
 * @package Brightcove\API\Request
 * @api
 */
class IngestRequestMaster extends ObjectBase
{
    protected ?string $url;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'url');
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;
        $this->fieldChanged('url');
        return $this;
    }
}
