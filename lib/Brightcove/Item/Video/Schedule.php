<?php

namespace Brightcove\Item\Video;

use Brightcove\Item\ItemBase;

/**
 * Creates a schedule Item, which represents when the video becomes available/unavailable
 *
 * @api
 */
class Schedule extends ItemBase {
  protected $starts_at;
  protected $ends_at;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'starts_at');
    $this->applyProperty($json, 'ends_at');
  }

  /**
   * @return string
   */
  public function getStartsAt() {
    return $this->starts_at;
  }

  /**
   * @param string $starts_at
   * @return $this
   */
  public function setStartsAt($starts_at) {
    $this->starts_at = $starts_at;
    $this->fieldChanged('starts_at');
    return $this;
  }

  /**
   * @return string
   */
  public function getEndsAt() {
    return $this->ends_at;
  }

  /**
   * @param string $ends_at
   * @return $this
   */
  public function setEndsAt($ends_at) {
    $this->ends_at = $ends_at;
    $this->fieldChanged('ends_at');
    return $this;
  }
}
