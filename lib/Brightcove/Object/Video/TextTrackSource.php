<?php

namespace Brightcove\Object\Video;

use Brightcove\Object\ObjectBase;

/**
 * Class TextTrackSource
 *
 * @package Brightcove\Object\Video
 * @api
 */
class TextTrackSource extends ObjectBase {

  /**
   * @var string
   */
  protected $src;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'src');
  }

  /**
   * @return string
   */
  public function getSrc() {
    return $this->src;
  }

  /**
   * @param string $src
   * @return TextTrackSource
   */
  public function setSrc($src) {
    $this->src = $src;
    $this->fieldChanged('src');
    return $this;
  }
}
