<?php

declare(strict_types=1);

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * Creates a schedule object, which represents when the video becomes available/unavailable
 *
 * @api
 */
class Schedule extends ObjectBase
{
    protected ?string $starts_at = null;
    protected ?string $ends_at = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'starts_at');
        $this->applyProperty($json, 'ends_at');
    }

    public function getStartsAt(): ?string
    {
        return $this->starts_at;
    }

    public function setStartsAt(string $starts_at): static
    {
        $this->starts_at = $starts_at;
        $this->fieldChanged('starts_at');
        return $this;
    }

    public function getEndsAt(): ?string
    {
        return $this->ends_at;
    }

    public function setEndsAt(string $ends_at): static
    {
        $this->ends_at = $ends_at;
        $this->fieldChanged('ends_at');
        return $this;
    }
}
