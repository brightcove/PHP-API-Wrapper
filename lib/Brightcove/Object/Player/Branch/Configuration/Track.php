<?php

namespace Brightcove\Object\Player\Branch\Configuration;

use Brightcove\Object\ObjectBase;

/**
 * Class Track
 *
 * @package Brightcove\Object\Player\Branch\Configuration
 * @api
 */
class Track extends ObjectBase {

  /**
   * @var string
   */
  protected $label;

  /**
   * @var string
   */
  protected $src;

  /**
   * @var string
   */
  protected $srclang;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'label');
    $this->applyProperty($json, 'src');
    $this->applyProperty($json, 'srclang');
  }

  /**
   * @return string
   */
  public function getLabel() {
    return $this->label;
  }

  /**
   * @param string $label
   *
   * @return Track
   */
  public function setLabel($label) {
    $this->label = $label;
    return $this;
  }

  /**
   * @return string
   */
  public function getSrc() {
    return $this->src;
  }

  /**
   * @param string $src
   *
   * @return Track
   */
  public function setSrc($src) {
    $this->src = $src;
    return $this;
  }

  /**
   * @return string
   */
  public function getSrclang() {
    return $this->srclang;
  }

  /**
   * @param string $srclang
   *
   * @return Track
   */
  public function setSrclang($srclang) {
    $this->srclang = $srclang;
    return $this;
  }

}
