<?php

namespace Brightcove\Item\Player;

use Brightcove\Item\ItemBase;

/**
 * Class UpdateData
 *
 * @package Brightcove\Item\Player
 * @api
 */
class UpdateData extends ItemBase {

  /**
   * @var string
   */
  protected $name;

  /**
   * @var string
   */
  protected $description;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'name');
    $this->applyProperty($json, 'description');
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param string $name
   *
   * @return UpdateData
   */
  public function setName($name) {
    $this->name = $name;
    $this->fieldChanged('name');
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
   *
   * @return UpdateData
   */
  public function setDescription($description) {
    $this->description = $description;
    $this->fieldChanged('description');
    return $this;
  }

}
