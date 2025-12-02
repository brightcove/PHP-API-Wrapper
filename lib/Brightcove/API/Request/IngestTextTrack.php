<?php

declare(strict_types=1);

namespace Brightcove\API\Request;

use Brightcove\Item\ObjectBase;

/**
 * Class IngestTextTrack
 *
 * @package Brightcove\API\Request
 * @api
 */
class IngestTextTrack extends ObjectBase
{
    protected ?string $url = null;
    protected ?string $srclang = null;
    protected ?string $label = null;

    /**
     * Allowed values: captions, subtitles, descriptions, chapters, metadata.
     */
    protected ?string $kind;

    protected bool $default = false;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'url');
        $this->applyProperty($json, 'srclang');
        $this->applyProperty($json, 'label');
        $this->applyProperty($json, 'kind');
        $this->applyProperty($json, 'default');
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

    public function getSrclang(): ?string
    {
        return $this->srclang;
    }

    public function setSrclang(string $srclang): static
    {
        $this->srclang = $srclang;
        $this->fieldChanged('srclang');
        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;
        $this->fieldChanged('label');
        return $this;
    }

    public function getKind(): ?string
    {
        return $this->kind;
    }

    public function setKind(string $kind): static
    {
        $this->kind = $kind;
        $this->fieldChanged('kind');
        return $this;
    }

    public function isDefault(): bool
    {
        return $this->default;
    }

    public function setDefault(bool $default): static
    {
        $this->default = $default;
        $this->fieldChanged('default');
        return $this;
    }
}
