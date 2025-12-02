<?php

declare(strict_types=1);

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * Class MediaSource
 *
 * @package Brightcove\Item\Player\Branch\Configuration
 * @api
 */
class MediaSource extends ObjectBase
{
    protected ?string $type = null;
    protected ?string $src = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'type');
        $this->applyProperty($json, 'src');
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;
        $this->fieldChanged('type');
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
}
