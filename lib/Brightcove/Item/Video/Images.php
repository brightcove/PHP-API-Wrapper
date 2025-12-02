<?php

declare(strict_types=1);

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * Provides a poster or a thumbnail preview.
 *
 * @api
 */
class Images extends ObjectBase
{
    protected ?Image $thumbnail = null;
    protected ?Image $poster = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'thumbnail');
        $this->applyProperty($json, 'poster');
    }

    public function getThumbnail(): ?Image
    {
        return $this->thumbnail;
    }

    public function setThumbnail(Image $thumbnail): static
    {
        $this->thumbnail = $thumbnail;
        $this->fieldChanged('thumbnail');
        return $this;
    }

    public function getPoster(): ?Image
    {
        return $this->poster;
    }

    public function setPoster(Image $poster): static
    {
        $this->poster = $poster;
        $this->fieldChanged('poster');
        return $this;
    }
}
