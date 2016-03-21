<?php

namespace Brightcove\Object\Player\Branch\Configuration;

use Brightcove\Object\ObjectBase;

class CSS extends ObjectBase {

  /**
   * @var string
   */
  protected $controlBarColor;

  /**
   * @var string
   */
  protected $controlColor;

  /**
   * @var string
   */
  protected $progressColor;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'controlBarColor');
    $this->applyProperty($json, 'controlColor');
    $this->applyProperty($json, 'progressColor');
  }

  /**
   * @return string
   */
  public function getControlBarColor() {
    return $this->controlBarColor;
  }

  /**
   * @param string $controlBarColor
   * @return CSS
   */
  public function setControlBarColor($controlBarColor) {
    $this->controlBarColor = $controlBarColor;
    $this->fieldChanged('controlBarColor');
    return $this;
  }

  /**
   * @return string
   */
  public function getControlColor() {
    return $this->controlColor;
  }

  /**
   * @param string $controlColor
   * @return CSS
   */
  public function setControlColor($controlColor) {
    $this->controlColor = $controlColor;
    $this->fieldChanged('controlColor');
    return $this;
  }

  /**
   * @return string
   */
  public function getProgressColor() {
    return $this->progressColor;
  }

  /**
   * @param string $progressColor
   * @return CSS
   */
  public function setProgressColor($progressColor) {
    $this->progressColor = $progressColor;
    $this->fieldChanged('progressColor');
    return $this;
  }
}
