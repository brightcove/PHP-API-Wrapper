<?php

declare(strict_types=1);

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * This class creates marker objects for midroll ad requests or some other action to be created via the player API
 *
 * @api
 */
class CuePoint extends ObjectBase
{
    protected ?string $name = null;
    protected ?string $type = null;
    protected ?float $time = null;
    protected ?string $metadata = null;
    protected bool $force_stop = false;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'name');
        $this->applyProperty($json, 'type');
        $this->applyProperty($json, 'time');
        $this->applyProperty($json, 'metadata');
        $this->applyProperty($json, 'force_stop');
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        $this->fieldChanged('name');
        return $this;
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

    public function getTime(): ?float
    {
        return $this->time;
    }

    public function setTime(float $time): static
    {
        $this->time = $time;
        $this->fieldChanged('time');
        return $this;
    }

    public function getMetadata(): ?string
    {
        return $this->metadata;
    }

    public function setMetadata(string $metadata): static
    {
        $this->metadata = $metadata;
        $this->fieldChanged('metadata');
        return $this;
    }

    public function getForceStop(): bool
    {
        return $this->force_stop;
    }

    public function setForceStop(bool $force_stop): static
    {
        $this->force_stop = $force_stop;
        $this->fieldChanged('force_stop');
        return $this;
    }
}
