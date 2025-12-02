<?php

declare(strict_types=1);

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * Class TextTrack
 *
 * @package Brightcove\Item\Video
 * @api
 */
class TextTrack extends ObjectBase
{
    protected ?string $id = null;
    protected ?string $src = null;
    protected ?string $srclang = null;
    protected ?string $label = null;
    protected ?string $kind = null;
    protected ?string $mime_type = null;
    protected ?string $asset_id = null;

    /**
     * @var TextTrackSource[]
     */
    protected array $sources = [];

    protected bool $default = false;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'src');
        $this->applyProperty($json, 'srclang');
        $this->applyProperty($json, 'label');
        $this->applyProperty($json, 'kind');
        $this->applyProperty($json, 'mime_type');
        $this->applyProperty($json, 'asset_id');
        $this->applyProperty($json, 'sources', null, TextTrackSource::class, true);
        $this->applyProperty($json, 'default');
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

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function setSrc(string $src): static
    {
        $this->src = $src;
        $this->fieldChanged('src');
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

    public function getMimeType(): ?string
    {
        return $this->mime_type;
    }

    public function setMimeType(string $mime_type): static
    {
        $this->mime_type = $mime_type;
        $this->fieldChanged('mime_type');
        return $this;
    }

    public function getAssetId(): ?string
    {
        return $this->asset_id;
    }

    public function setAssetId(string $asset_id): static
    {
        $this->asset_id = $asset_id;
        $this->fieldChanged('asset_id');
        return $this;
    }

    public function getSources(): array
    {
        return $this->sources;
    }

    public function setSources(array $sources): static
    {
        $this->sources = $sources;
        $this->fieldChanged('sources');
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
