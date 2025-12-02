<?php

declare(strict_types=1);

namespace Brightcove\Item;

/**
 * Class CustomField
 *
 * @package Brightcove\Item
 * @api
 */
class CustomField extends ObjectBase
{
    protected ?string $id = null;
    protected ?string $display_name = null;
    protected ?string $description = null;
    protected bool $required = false;
    protected ?string $type = null;
    protected array $enum_values = [];

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'display_name');
        $this->applyProperty($json, 'description');
        $this->applyProperty($json, 'required');
        $this->applyProperty($json, 'type');
        $this->applyProperty($json, 'enum_values');
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;
        $this->fieldChanged('id');
        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->display_name;
    }

    public function setDisplayName(string $display_name): static
    {
        $this->display_name = $display_name;
        $this->fieldChanged('display_name');
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

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): static
    {
        $this->required = $required;
        $this->fieldChanged('required');
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

    public function getEnumValues(): array
    {
        return $this->enum_values;
    }

    public function setEnumValues(array $enum_values): static
    {
        $this->enum_values = $enum_values;
        $this->fieldChanged('enum_values');
        return $this;
    }
}
