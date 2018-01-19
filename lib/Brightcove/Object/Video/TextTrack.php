<?php

namespace Brightcove\Object\Video;

use Brightcove\Object\ObjectBase;

/**
 * Class TextTrack
 *
 * @package Brightcove\Object\Video
 * @api
 */
class TextTrack extends ObjectBase {

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
   * @var string
   */
  protected $mime_type;

  /**
   * @var string
   */
  protected $asset_id;

  /**
   * @var TextTrackSource[]
   */
  protected $sources;

  /**
   * @var boolean
   */
  protected $default;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'src');
    $this->applyProperty($json, 'srclang');
    $this->applyProperty($json, 'label');
    $this->applyProperty($json, 'kind');
    $this->applyProperty($json, 'mime_type');
    $this->applyProperty($json, 'asset_id');
    $this->applyProperty($json, 'sources', NULL, TextTrackSource::class, TRUE);
    $this->applyProperty($json, 'default');
  }

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   * @return TextTrack
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
   * @return TextTrack
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
   * @return TextTrack
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
   * @return TextTrack
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
   * @return TextTrack
   */
  public function setKind($kind) {
    $this->kind = $kind;
    $this->fieldChanged('kind');
    return $this;
  }

  /**
   * @return string
   */
  public function getMimeType() {
    return $this->mime_type;
  }

  /**
   * @param string $mime_type
   * @return TextTrack
   */
  public function setMimeType($mime_type) {
    $this->mime_type = $mime_type;
    $this->fieldChanged('mime_type');
    return $this;
  }

  /**
   * @return string
   */
  public function getAssetId() {
    return $this->asset_id;
  }

  /**
   * @param string $asset_id
   * @return TextTrack
   */
  public function setAssetId($asset_id) {
    $this->asset_id = $asset_id;
    $this->fieldChanged('asset_id');
    return $this;
  }

  /**
   * @return TextTrackSource[]
   */
  public function getSources() {
    return $this->sources;
  }

  /**
   * @param TextTrackSource[] $sources
   * @return TextTrack
   */
  public function setSources(array $sources) {
    $this->sources = $sources;
    $this->fieldChanged('sources');
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
   * @return TextTrack
   */
  public function setDefault($default) {
    $this->default = $default;
    $this->fieldChanged('default');
    return $this;
  }
}
