<?php

namespace Brightcove\API\Request;

use Brightcove\Object\ObjectBase;
use IngestImage;

class IngestRequest extends ObjectBase {
  /**
   * @var IngestRequestMaster
   */
  protected $master;

  /**
   * @var string
   */
  protected $profile;

  /**
   * @var array
   */
  protected $callbacks;

  /**
   * @var bool
   */
  protected $capture_images;

  /**
   * @var IngestImage
   */
  protected $poster;

  /**
   * @var IngestImage
   */
  protected $thumbnail;

  public static function createRequest($url, $profile) {
    $request = new self();
    $request->setMaster(new IngestRequestMaster());
    $request->getMaster()->setUrl($url);
    $request->setProfile($profile);

    return $request;
  }

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'master');
    $this->applyProperty($json, 'profile');
    $this->applyProperty($json, 'callbacks');
    $this->applyProperty($json, 'capture_images');
    $this->applyProperty($json, 'poster');
    $this->applyProperty($json, 'thumbnail');
  }

  /**
   * @return IngestRequestMaster
   */
  public function getMaster() {
    return $this->master;
  }

  /**
   * @param IngestRequestMaster $master
   * @return $this
   */
  public function setMaster(IngestRequestMaster $master = NULL) {
    $this->master = $master;
    $this->fieldChanged('master');
    return $this;
  }

  /**
   * @return string
   */
  public function getProfile() {
    return $this->profile;
  }

  /**
   * @param string $profile
   * @return $this
   */
  public function setProfile($profile) {
    $this->profile = $profile;
    $this->fieldChanged('profile');
    return $this;
  }

  /**
   * @return array
   */
  public function getCallbacks() {
    return $this->callbacks;
  }

  /**
   * @param array $callbacks
   * @return $this
   */
  public function setCallbacks(array $callbacks) {
    $this->callbacks = $callbacks;
    $this->fieldChanged('callbacks');
    return $this;
  }

  /**
   * @return boolean
   */
  public function isCaptureImages() {
    return $this->capture_images;
  }

  /**
   * @param boolean $capture_images
   * @return IngestRequest
   */
  public function setCaptureImages(IngestRequest $capture_images) {
    $this->capture_images = $capture_images;
    $this->fieldChanged('capture_images');
    return $this;
  }

  /**
   * @return IngestImage
   */
  public function getPoster() {
    return $this->poster;
  }

  /**
   * @param IngestImage $poster
   * @return IngestRequest
   */
  public function setPoster(IngestRequest $poster) {
    $this->poster = $poster;
    $this->fieldChanged('poster');
    return $this;
  }

  /**
   * @return IngestImage
   */
  public function getThumbnail() {
    return $this->thumbnail;
  }

  /**
   * @param IngestImage $thumbnail
   * @return IngestRequest
   */
  public function setThumbnail(IngestRequest $thumbnail) {
    $this->thumbnail = $thumbnail;
    $this->fieldChanged('thumbnail');
    return $this;
  }
}
