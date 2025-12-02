<?php

declare(strict_types=1);

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * Class Plugin
 *
 * @package Brightcove\Item\Player\Branch\Configuration
 * @api
 */
class Plugin extends ObjectBase
{
    protected ?string $name = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'name');
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
}
