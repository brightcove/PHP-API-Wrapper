<?php

declare(strict_types=1);

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * Class Track
 *
 * @package Brightcove\Item\Player\Branch\Configuration
 * @api
 */
class Track extends ObjectBase
{
    protected ?string $label = null;
    protected ?string $src = null;
    protected ?string $srclang = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'label');
        $this->applyProperty($json, 'src');
        $this->applyProperty($json, 'srclang');
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;
        return $this;
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function setSrc(string $src): static
    {
        $this->src = $src;
        return $this;
    }

    public function getSrclang(): ?string
    {
        return $this->srclang;
    }

    public function setSrclang(string $srclang): static
    {
        $this->srclang = $srclang;
        return $this;
    }
}
