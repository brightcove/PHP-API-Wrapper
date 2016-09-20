<?php

namespace Brightcove\Object\Video;

use Brightcove\Object\ObjectBase;

/**
 * Thumbnail image
 */
class Thumbnail extends ObjectBase {
  protected $id;
  protected $remote_url;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'remote_url');
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
  public function getRemoteUrl() {
    return $this->remote_url;
  }

  /**
   * @param string $remote_url
   * @return $this
   */
  public function setRemoteUrl($remote_url) {
    $this->remote_url = $remote_url;
    $this->fieldChanged('remote_url');
    return $this;
  }
}