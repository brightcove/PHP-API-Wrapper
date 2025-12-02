<?php

declare(strict_types=1);

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * Class PlayerTemplate
 *
 * @package Brightcove\Item\Player\Branch\Configuration
 * @api
 */
class PlayerTemplate extends ObjectBase
{
    protected ?string $name = null;
    protected ?string $version = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'name');
        $this->applyProperty($json, 'version');
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

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): static
    {
        $this->version = $version;
        $this->fieldChanged('version');
        return $this;
    }
}
