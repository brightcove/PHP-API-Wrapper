<?php

namespace Brightcove\Object\Player;

use Brightcove\Object\ObjectBase;

/**
 * Class CreateResult
 *
 * @package Brightcove\Object\Player
 * @api
 */
class CreateResult extends ObjectBase {
  /**
   * @var string
   */
  protected $id;

  /**
   * @var string
   */
  protected $url;

  /**
   * @var string
   */
  protected $embed_code;

  /**
   * @var string
   */
  protected $embed_in_page;

  /**
   * @var string
   */
  protected $preview_url;

  /**
   * @var string
   */
  protected $preview_embed_code;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'url');
    $this->applyProperty($json, 'emebed_code');
    $this->applyProperty($json, 'embed_in_page');
    $this->applyProperty($json, 'preview_url');
    $this->applyProperty($json, 'preview_embed_code');
  }

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   * @return CreateResult
   */
  public function setId($id) {
    $this->id = $id;
    $this->fieldChanged('id');
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
   * @return CreateResult
   */
  public function setUrl($url) {
    $this->url = $url;
    $this->fieldChanged('url');
    return $this;
  }

  /**
   * @return string
   */
  public function getEmbedCode() {
    return $this->embed_code;
  }

  /**
   * @param string $embed_code
   * @return CreateResult
   */
  public function setEmbedCode($embed_code) {
    $this->embed_code = $embed_code;
    $this->fieldChanged('embed_code');
    return $this;
  }

  /**
   * @return string
   */
  public function getEmbedInPage() {
    return $this->embed_in_page;
  }

  /**
   * @param string $embed_in_page
   * @return CreateResult
   */
  public function setEmbedInPage($embed_in_page) {
    $this->embed_in_page = $embed_in_page;
    $this->fieldChanged('embed_in_page');
    return $this;
  }

  /**
   * @return string
   */
  public function getPreviewUrl() {
    return $this->preview_url;
  }

  /**
   * @param string $preview_url
   * @return CreateResult
   */
  public function setPreviewUrl($preview_url) {
    $this->preview_url = $preview_url;
    $this->fieldChanged('preview_url');
    return $this;
  }

  /**
   * @return string
   */
  public function getPreviewEmbedCode() {
    return $this->preview_embed_code;
  }

  /**
   * @param string $preview_embed_code
   * @return CreateResult
   */
  public function setPreviewEmbedCode($preview_embed_code) {
    $this->preview_embed_code = $preview_embed_code;
    $this->fieldChanged('preview_embed_code');
    return $this;
  }
}