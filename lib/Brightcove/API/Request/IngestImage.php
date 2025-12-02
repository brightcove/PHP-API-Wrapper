<?php

declare(strict_types=1);

namespace Brightcove\API\Request;

use Brightcove\Item\ObjectBase;

/**
 * Class IngestImage
 *
 * @package Brightcove\API\Request
 * @api
 */
class IngestImage extends ObjectBase
{
    protected ?string $url = null;
    protected ?int $width = null;
    protected ?int $height = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'url');
        $this->applyProperty($json, 'width');
        $this->applyProperty($json, 'height');
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

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(int $width): static
    {
        $this->width = $width;
        $this->fieldChanged('width');
        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): static
    {
        $this->height = $height;
        $this->fieldChanged('height');
        return $this;
    }
}
