<?php

namespace Brightcove\Object;

/**
 * Class CustomFields
 *
 * @package Brightcove\Object
 * @api
 */
class CustomFields extends ObjectBase {
  /**
   * @var int
   */
  protected $max_custom_fields;

  /**
   * @var CustomField[]
   */
  protected $custom_fields;

  /**
   * @var CustomField[]
   */
  protected $standard_fields;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'max_custom_fields');
    $this->applyProperty($json, 'custom_fields', NULL, CustomField::class, TRUE);
    $this->applyProperty($json, 'standard_fields', NULL, CustomField::class, TRUE);
  }

  /**
   * @return int
   */
  public function getMaxCustomFields() {
    return $this->max_custom_fields;
  }

  /**
   * @param int $max_custom_fields
   * @return CustomFields
   */
  public function setMaxCustomFields($max_custom_fields) {
    $this->max_custom_fields = $max_custom_fields;
    $this->fieldChanged('max_custom_fields');
    return $this;
  }

  /**
   * @return CustomField[]
   */
  public function getCustomFields() {
    return $this->custom_fields;
  }

  /**
   * @param CustomField[] $custom_fields
   * @return CustomFields
   */
  public function setCustomFields(array $custom_fields) {
    $this->custom_fields = $custom_fields;
    $this->fieldChanged('custom_fields');
    return $this;
  }

  /**
   * @return CustomField[]
   */
  public function getStandardFields() {
    return $this->standard_fields;
  }

  /**
   * @param CustomField[] $standard_fields
   * @return CustomFields
   */
  public function setStandardFields(array $standard_fields) {
    $this->standard_fields = $standard_fields;
    $this->fieldChanged('standard_fields');
    return $this;
  }
}
