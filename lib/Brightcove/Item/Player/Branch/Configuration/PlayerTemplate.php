<?php

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ItemBase;

/**
 * Class PlayerTemplate
 *
 * @package Brightcove\Item\Player\Branch\Configuration
 * @api
 */
class PlayerTemplate extends ItemBase {
  /**
   * @var string
   */
  protected $name;

  /**
   * @var string
   */
  protected $version;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'name');
    $this->applyProperty($json, 'version');
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param string $name
   * @return PlayerTemplate
   */
  public function setName($name) {
    $this->name = $name;
    $this->fieldChanged('name');
    return $this;
  }

  /**
   * @return string
   */
  public function getVersion() {
    return $this->version;
  }

  /**
   * @param string $version
   * @return PlayerTemplate
   */
  public function setVersion($version) {
    $this->version = $version;
    $this->fieldChanged('version');
    return $this;
  }
}
