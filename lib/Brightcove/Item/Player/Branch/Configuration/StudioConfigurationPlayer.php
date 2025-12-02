<?php

declare(strict_types=1);

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * Class StudioConfigurationPlayer
 *
 * @package Brightcove\Item\Player\Branch\Configuration
 * @api
 */
class StudioConfigurationPlayer extends ObjectBase
{
    protected bool $adjusted = false;
    protected ?float $height = null;
    protected ?float $width = null;
    protected bool $responsive = false;
    protected ?string $units = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'adjusted');
        $this->applyProperty($json, 'height');
        $this->applyProperty($json, 'width');
        $this->applyProperty($json, 'units');
        $this->applyProperty($json, 'responsive');
    }

    public function isAdjusted(): bool
    {
        return $this->adjusted;
    }

    public function setAdjusted(bool $adjusted): static
    {
        $this->adjusted = $adjusted;
        $this->fieldChanged('adjusted');
        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): static
    {
        $this->height = $height;
        $this->fieldChanged('height');
        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(float $width): static
    {
        $this->width = $width;
        $this->fieldChanged('width');
        return $this;
    }

    public function getUnits(): ?string
    {
        return $this->units;
    }

    public function setUnits(string $units): static
    {
        $this->units = $units;
        $this->fieldChanged('units');
        return $this;
    }

    public function isResponsive(): bool
    {
        return $this->responsive;
    }

    /**
     * @param bool $is_response
     * @return StudioConfigurationPlayer
     */
    public function setResponse(bool $is_response): static
    {
        $this->responsive = $is_response;
        $this->fieldChanged('responsive');
        return $this;
    }
}
