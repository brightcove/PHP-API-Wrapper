<?php

namespace Brightcove\API\Request;

use Brightcove\Object\ObjectBase;

class IngestImage extends ObjectBase {
  /**
   * @var string
   */
  protected $url;

  /**
   * @var int
   */
  protected $width;

  /**
   * @var int
   */
  protected $height;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'url');
    $this->applyProperty($json, 'width');
    $this->applyProperty($json, 'height');
  }

  /**
   * @return string
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * @param string $url
   * @return IngestImage
   */
  public function setUrl($url) {
    $this->url = $url;
    $this->fieldChanged('url');
    return $this;
  }

  /**
   * @return int
   */
  public function getWidth() {
    return $this->width;
  }

  /**
   * @param int $width
   * @return IngestImage
   */
  public function setWidth($width) {
    $this->width = $width;
    $this->fieldChanged('width');
    return $this;
  }

  /**
   * @return int
   */
  public function getHeight() {
    return $this->height;
  }

  /**
   * @param int $height
   * @return IngestImage
   */
  public function setHeight($height) {
    $this->height = $height;
    $this->fieldChanged('height');
    return $this;
  }
}
