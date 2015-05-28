<?php

namespace Brightcove\Object\Video;

use Brightcove\Object\ObjectBase;

/**
 * This class creates marker objects for midroll ad requests or some other action to be created via the player API
 */
class CuePoint extends ObjectBase {
  protected $name;
  protected $type;
  protected $time;
  protected $metadata;
  protected $force_stop;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'name');
    $this->applyProperty($json, 'type');
    $this->applyProperty($json, 'time');
    $this->applyProperty($json, 'metadata');
    $this->applyProperty($json, 'force_stop');
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param string $name
   * @return $this
   */
  public function setName($name) {
    $this->name = $name;
    $this->fieldChanged('name');
    return $this;
  }

  /**
   * @return string
   */
  public function getType() {
    return $this->type;
  }

  /**
   * @param string $type
   * @return $this
   */
  public function setType($type) {
    $this->type = $type;
    $this->fieldChanged('type');
    return $this;
  }

  /**
   * @return float
   */
  public function getTime() {
    return $this->time;
  }

  /**
   * @param float $time
   * @return $this
   */
  public function setTime($time) {
    $this->time = $time;
    $this->fieldChanged('time');
    return $this;
  }

  /**
   * @return string
   */
  public function getMetadata() {
    return $this->metadata;
  }

  /**
   * @param string $metadata
   * @return $this
   */
  public function setMetadata($metadata) {
    $this->metadata = $metadata;
    $this->fieldChanged('metadata');
    return $this;
  }

  /**
   * @return string
   */
  public function getForceStop() {
    return $this->force_stop;
  }

  /**
   * @param string $force_stop
   * @return $this
   */
  public function setForceStop($force_stop) {
    $this->force_stop = $force_stop;
    $this->fieldChanged('force_stop');
    return $this;
  }
}
