<?php

declare(strict_types=1);

namespace Brightcove\Item\Player;

use Brightcove\Item\ObjectBase;

/**
 * Class CreateResult
 *
 * @package Brightcove\Item\Player
 * @api
 */
class CreateResult extends ObjectBase
{
    protected ?string $id;
    protected ?string $url;
    protected ?string $embed_code;
    protected ?string $embed_in_page;
    protected ?string $preview_url;
    protected ?string $preview_embed_code;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'url');
        $this->applyProperty($json, 'emebed_code');
        $this->applyProperty($json, 'embed_in_page');
        $this->applyProperty($json, 'preview_url');
        $this->applyProperty($json, 'preview_embed_code');
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

    public function getEmbedCode(): ?string
    {
        return $this->embed_code;
    }

    public function setEmbedCode(string $embed_code): static
    {
        $this->embed_code = $embed_code;
        $this->fieldChanged('embed_code');
        return $this;
    }

    public function getEmbedInPage(): ?string
    {
        return $this->embed_in_page;
    }

    public function setEmbedInPage(string $embed_in_page): static
    {
        $this->embed_in_page = $embed_in_page;
        $this->fieldChanged('embed_in_page');
        return $this;
    }

    public function getPreviewUrl(): ?string
    {
        return $this->preview_url;
    }

    public function setPreviewUrl(string $preview_url): static
    {
        $this->preview_url = $preview_url;
        $this->fieldChanged('preview_url');
        return $this;
    }

    public function getPreviewEmbedCode(): ?string
    {
        return $this->preview_embed_code;
    }

    public function setPreviewEmbedCode(string $preview_embed_code): static
    {
        $this->preview_embed_code = $preview_embed_code;
        $this->fieldChanged('preview_embed_code');
        return $this;
    }
}
