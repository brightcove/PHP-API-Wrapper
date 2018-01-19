<?php

namespace Brightcove\Object\Player\Branch\Configuration;

use Brightcove\Object\ObjectBase;

/**
 * Class VideoCloud
 *
 * @package Brightcove\Object\Player\Branch\Configuration
 * @api
 */
class VideoCloud extends ObjectBase {

  /**
   * @var string
   */
  protected $policy_key;

  /**
   * @var string
   */
  protected $video;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'policy_key');
    $this->applyProperty($json, 'video');
  }

  /**
   * @return string
   */
  public function getPolicyKey() {
    return $this->policy_key;
  }

  /**
   * @param string $policy_key
   * @return VideoCloud
   */
  public function setPolicyKey($policy_key) {
    $this->policy_key = $policy_key;
    $this->fieldChanged('policy_key');
    return $this;
  }

  /**
   * @return string
   */
  public function getVideo() {
    return $this->video;
  }

  /**
   * @param string $video
   * @return VideoCloud
   */
  public function setVideo($video) {
    $this->video = $video;
    $this->fieldChanged('video');
    return $this;
  }

}
