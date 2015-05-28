<?php

namespace Brightcove\Object;

class CustomField extends ObjectBase {
  /**
   * @var string
   */
  protected $id;

  /**
   * @var string
   */
  protected $display_name;

  /**
   * @var string
   */
  protected $description;

  /**
   * @var bool
   */
  protected $required;

  /**
   * @var string
   */
  protected $type;

  /**
   * @var array
   */
  protected $enum_values;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'display_name');
    $this->applyProperty($json, 'description');
    $this->applyProperty($json, 'required');
    $this->applyProperty($json, 'type');
    $this->applyProperty($json, 'enum_values');
  }

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   * @return CustomField
   */
  public function setId($id) {
    $this->id = $id;
    $this->fieldChanged('id');
    return $this;
  }

  /**
   * @return string
   */
  public function getDisplayName() {
    return $this->display_name;
  }

  /**
   * @param string $display_name
   * @return CustomField
   */
  public function setDisplayName($display_name) {
    $this->display_name = $display_name;
    $this->fieldChanged('display_name');
    return $this;
  }

  /**
   * @return string
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * @param string $description
   * @return CustomField
   */
  public function setDescription($description) {
    $this->description = $description;
    $this->fieldChanged('description');
    return $this;
  }

  /**
   * @return boolean
   */
  public function isRequired() {
    return $this->required;
  }

  /**
   * @param boolean $required
   * @return CustomField
   */
  public function setRequired($required) {
    $this->required = $required;
    $this->fieldChanged('required');
    return $this;
  }

  /**
   * @return string
   */
  public function getType() {
    return $this->type;
  }

  /**
   * @param string $type
   * @return CustomField
   */
  public function setType($type) {
    $this->type = $type;
    $this->fieldChanged('type');
    return $this;
  }

  /**
   * @return array
   */
  public function getEnumValues() {
    return $this->enum_values;
  }

  /**
   * @param array $enum_values
   * @return CustomField
   */
  public function setEnumValues(array $enum_values) {
    $this->enum_values = $enum_values;
    $this->fieldChanged('enum_values');
    return $this;
  }

}
