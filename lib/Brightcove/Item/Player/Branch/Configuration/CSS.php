<?php

declare(strict_types=1);

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * Class CSS
 *
 * @package Brightcove\Item\Player\Branch\Configuration
 * @api
 */
class CSS extends ObjectBase
{
    protected ?string $controlBarColor = null;
    protected ?string $controlColor = null;
    protected ?string $progressColor = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'controlBarColor');
        $this->applyProperty($json, 'controlColor');
        $this->applyProperty($json, 'progressColor');
    }

    public function getControlBarColor(): ?string
    {
        return $this->controlBarColor;
    }

    public function setControlBarColor(string $controlBarColor): static
    {
        $this->controlBarColor = $controlBarColor;
        $this->fieldChanged('controlBarColor');
        return $this;
    }

    public function getControlColor(): ?string
    {
        return $this->controlColor;
    }

    public function setControlColor(string $controlColor): static
    {
        $this->controlColor = $controlColor;
        $this->fieldChanged('controlColor');
        return $this;
    }

    public function getProgressColor(): ?string
    {
        return $this->progressColor;
    }

    public function setProgressColor(string $progressColor): static
    {
        $this->progressColor = $progressColor;
        $this->fieldChanged('progressColor');
        return $this;
    }
}
