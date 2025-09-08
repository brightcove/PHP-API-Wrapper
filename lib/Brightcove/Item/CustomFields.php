<?php

declare(strict_types=1);

namespace Brightcove\Item;

/**
 * Video custom fields.
 *
 * @package Brightcove\Item
 * @api
 */
class CustomFields extends ObjectBase
{
    /**
     * Maximum number of custom fields.
     */
    protected int $max_custom_fields;

    /**
     * List of custom fields.
     *
     * @var CustomField[]
     */
    protected array $custom_fields;

    /**
     * List of standard fields.
     *
     * @var CustomField[]
     */
    protected array $standard_fields;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'max_custom_fields');
        $this->applyProperty($json, 'custom_fields', null, CustomField::class, true);
        $this->applyProperty($json, 'standard_fields', null, CustomField::class, true);
    }

    /**
     * Gets the number of maximum custom fields.
     *
     * @return int
     *   Number of maximum fields.
     */
    public function getMaxCustomFields(): int
    {
        return $this->max_custom_fields;
    }

    /**
     * Sets the maximum custom fields number.
     *
     * @param int $max_custom_fields
     *   Maximum number of custom fields.
     */
    public function setMaxCustomFields(int $max_custom_fields): void
    {
        $this->max_custom_fields = $max_custom_fields;
        $this->fieldChanged('max_custom_fields');
    }

    /**
     * Gets custom fields.
     *
     * @return CustomField[]
     *   List of custom fields.
     */
    public function getCustomFields(): array
    {
        return $this->custom_fields;
    }

    /**
     * Sets custom fields.
     *
     * @param CustomField[] $custom_fields
     *   List of custom fields.
     */
    public function setCustomFields(array $custom_fields): void
    {
        $this->custom_fields = $custom_fields;
        $this->fieldChanged('custom_fields');
    }

    /**
     * Gets standard fields.
     *
     * @return CustomField[]
     *   List of standard fields.
     */
    public function getStandardFields(): array
    {
        return $this->standard_fields;
    }

    /**
     * Sets standard fields.
     *
     * @param CustomField[] $standard_fields
     *   List of standard fields.
     */
    public function setStandardFields(array $standard_fields): void
    {
        $this->standard_fields = $standard_fields;
        $this->fieldChanged('standard_fields');
    }
}
