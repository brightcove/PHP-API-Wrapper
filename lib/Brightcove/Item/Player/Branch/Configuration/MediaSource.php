<?php

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ItemBase;

/**
 * Class MediaSource
 *
 * @package Brightcove\Item\Player\Branch\Configuration
 * @api
 */
class MediaSource extends ItemBase {
  /**
   * @var string
   */
  protected $type;

  /**
   * @var string
   */
  protected $src;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'type');
    $this->applyProperty($json, 'src');
  }

  /**
   * @return string
   */
  public function getType() {
    return $this->type;
  }

  /**
   * @param string $type
   * @return MediaSource
   */
  public function setType($type) {
    $this->type = $type;
    $this->fieldChanged('type');
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
   * @return MediaSource
   */
  public function setSrc($src) {
    $this->src = $src;
    $this->fieldChanged('src');
    return $this;
  }
}
