<?php

declare(strict_types=1);

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * Creates a link object which has two separeted string field.
 *
 * @api
 */
class Link extends ObjectBase
{
    /**
     * Display text for the link.
     */
    protected ?string $text = null;

    /**
     * URL for the link.
     */
    protected ?string $url = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'url');
        $this->applyProperty($json, 'text');
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;
        $this->fieldChanged('text');
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
}
