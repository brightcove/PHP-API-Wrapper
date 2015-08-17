<?php

namespace Brightcove\API\Request;

use Brightcove\Object\ObjectBase;

class IngestRequestMaster extends ObjectBase {
  protected $url;
  protected $capture_images;

  public function __construct() {
    $this->fieldAliases["capure_images"] = "capture-images";
  }

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'url');
    $this->applyProperty($json, 'capture_images');
  }

  /**
   * @return mixed
   */
  public function getCaptureImages() {
    return $this->capture_images;
  }

  /**
   * @param mixed $capture_images
   * @return IngestRequestMaster
   */
  public function setCaptureImages($capture_images) {
    $this->capture_images = $capture_images;
    $this->fieldChanged('capture_images');
    return $this;
  }

  /**
   * @return string
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * @param string $url
   * @return $this
   */
  public function setUrl($url) {
    $this->url = $url;
    $this->fieldChanged('url');
    return $this;
  }
}
