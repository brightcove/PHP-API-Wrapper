<?php

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * Class Plugin
 *
 * @package Brightcove\Item\Player\Branch\Configuration
 * @api
 */
class Plugin extends ObjectBase {
  /**
   * @var string
   */
  protected $name;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'name');
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param string $name
   * @return Plugin
   */
  public function setName($name) {
    $this->name = $name;
    $this->fieldChanged('name');
    return $this;
  }
}