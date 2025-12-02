<?php

declare(strict_types=1);

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * Class TextTrackSource
 *
 * @package Brightcove\Item\Video
 * @api
 */
class TextTrackSource extends ObjectBase
{
    protected ?string $src = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'src');
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
}
