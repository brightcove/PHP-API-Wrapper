<?php

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * Class Transcription
 *
 * @package Brightcove\Item\Video
 * @api
 */
class Transcription extends ObjectBase {

  /**
   * @var string
   */
  protected $id;

  /**
   * @var string
   */
  protected $src;

  /**
   * @var string
   */
  protected $srclang;

  /**
   * @var string
   */
  protected $label;

  /**
   * @var string
   */
  protected $kind;

  /**
   * @var boolean
   */
  protected $default;

  /**
   * @var boolean
   */
  protected $autodetect;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'src');
    $this->applyProperty($json, 'srclang');
    $this->applyProperty($json, 'label');
    $this->applyProperty($json, 'kind');
    $this->applyProperty($json, 'default');
    $this->applyProperty($json, 'autodetect');
  }

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   * @return Transcription
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
   * @return Transcription
   */
  public function setSrc($src) {
    $this->src = $src;
    $this->fieldChanged('src');
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
   * @return Transcription
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
   * @return Transcription
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
   * @return Transcription
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
   * @return Transcription
   */
  public function setDefault($default) {
    $this->default = $default;
    $this->fieldChanged('default');
    return $this;
  }

  /**
   * @return boolean
   */
  public function isAutoDetect() {
    return $this->autodetect;
  }

  /**
   * @param boolean $autodetect
   * @return Transcription
   */
  public function setAutoDetect($autodetect) {
    $this->autodetect = $autodetect;
    $this->fieldChanged('autodetect');
    return $this;
  }
}
