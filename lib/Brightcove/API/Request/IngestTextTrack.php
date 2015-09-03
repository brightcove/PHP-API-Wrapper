<?php

namespace Brightcove\API\Request;

use Brightcove\Object\ObjectBase;

class IngestTextTrack extends ObjectBase {

  /**
   * @var string
   */
  protected $url;

  /**
   * @var string
   */
  protected $srclang;

  /**
   * @var string
   */
  protected $label;

  /**
   * allowed values: captions | subtitles | descriptions | chapters | metadata
   *
   * @var string
   */
  protected $kind;

  /**
   * @var boolean
   */
  protected $default;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'url');
    $this->applyProperty($json, 'srclang');
    $this->applyProperty($json, 'label');
    $this->applyProperty($json, 'kind');
    $this->applyProperty($json, 'default');
  }

  /**
   * @return string
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * @param string $url
   * @return IngestTextTrack
   */
  public function setUrl($url) {
    $this->url = $url;
    $this->fieldChanged('url');
    return $this;
  }

  /**
   * @return string
   */
  public function getSrclang() {
    return $this->srclang;
  }

  /**
   * @param string $srclang
   * @return IngestTextTrack
   */
  public function setSrclang($srclang) {
    $this->srclang = $srclang;
    $this->fieldChanged('srclang');
    return $this;
  }

  /**
   * @return string
   */
  public function getLabel() {
    return $this->label;
  }

  /**
   * @param string $label
   * @return IngestTextTrack
   */
  public function setLabel($label) {
    $this->label = $label;
    $this->fieldChanged('label');
    return $this;
  }

  /**
   * @return string
   */
  public function getKind() {
    return $this->kind;
  }

  /**
   * @param string $kind
   * @return IngestTextTrack
   */
  public function setKind($kind) {
    $this->kind = $kind;
    $this->fieldChanged('kind');
    return $this;
  }

  /**
   * @return boolean
   */
  public function isDefault() {
    return $this->default;
  }

  /**
   * @param boolean $default
   * @return IngestTextTrack
   */
  public function setDefault($default) {
    $this->default = $default;
    $this->fieldChanged('default');
    return $this;
  }

}
