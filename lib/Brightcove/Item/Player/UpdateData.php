<?php

declare(strict_types=1);

namespace Brightcove\Item\Player;

use Brightcove\Item\ObjectBase;

/**
 * Class UpdateData
 *
 * @package Brightcove\Item\Player
 * @api
 */
class UpdateData extends ObjectBase
{
    protected ?string $name = null;
    protected ?string $description = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'name');
        $this->applyProperty($json, 'description');
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        $this->fieldChanged('description');
        return $this;
    }
}
