<?php

namespace Brightcove\Item\Video;

use Brightcove\Item\ItemBase;

/**
 * An image what represents a video, only can be thumbnail or poster.
 * @api
 */
class Image extends ItemBase {
  protected $id;
  protected $src;
  protected $sources;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'src');
    $this->applyProperty($json, 'sources');
  }

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   * @return $this
   */
  public function setId($id) {
    $this->id = $id;
    $this->fieldChanged('id');
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
   * @return $this
   */
  public function setSrc($src) {
    $this->src = $src;
    $this->fieldChanged('src');
    return $this;
  }

  /**
   * @return array
   */
  public function getSources() {
    return $this->sources;
  }

  /**
   * @param array $sources
   * @return $this
   */
  public function setSources(array $sources) {
    $this->sources = $sources;
    $this->fieldChanged('sources');
    return $this;
  }
}
