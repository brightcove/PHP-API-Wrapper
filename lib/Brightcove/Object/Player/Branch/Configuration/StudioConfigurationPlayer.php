<?php

namespace Brightcove\Object\Player\Branch\Configuration;

use Brightcove\Object\ObjectBase;

/**
 * Class StudioConfigurationPlayer
 *
 * @package Brightcove\Object\Player\Branch\Configuration
 * @api
 */
class StudioConfigurationPlayer extends ObjectBase {

  /**
   * @var bool
   */
  protected $adjusted;

  /**
   * @var string
   */
  protected $height;

  /**
   * @var string
   */
  protected $width;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'adjusted');
    $this->applyProperty($json, 'height');
    $this->applyProperty($json, 'width');
  }

  /**
   * @return boolean
   */
  public function isAdjusted() {
    return $this->adjusted;
  }

  /**
   * @param boolean $adjusted
   * @return StudioConfigurationPlayer
   */
  public function setAdjusted($adjusted) {
    $this->adjusted = $adjusted;
    $this->fieldChanged('adjusted');
    return $this;
  }

  /**
   * @return string
   */
  public function getHeight() {
    return $this->height;
  }

  /**
   * @param string $height
   * @return StudioConfigurationPlayer
   */
  public function setHeight($height) {
    $this->height = $height;
    $this->fieldChanged('height');
    return $this;
  }

  /**
   * @return string
   */
  public function getWidth() {
    return $this->width;
  }

  /**
   * @param string $width
   * @return StudioConfigurationPlayer
   */
  public function setWidth($width) {
    $this->width = $width;
    $this->fieldChanged('width');
    return $this;
  }

}
