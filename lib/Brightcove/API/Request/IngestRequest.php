<?php

namespace Brightcove\API\Request;

use Brightcove\API\Request\IngestRequestMaster;
use Brightcove\Object\ObjectBase;

class IngestRequest extends ObjectBase {
  /**
   * @var IngestRequestMaster
   */
  protected $master;

  protected $profile;

  protected $callbacks;

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
}