<?php

namespace Brightcove\Object\Player;

use Brightcove\Object\ObjectBase;
use Brightcove\Object\Player\Branch\BranchList;
use Brightcove\Object\Player\Embed\PublishRequest;

/**
 * Class Embed
 *
 * @package Brightcove\Object\Player
 * @api
 */
class Embed extends ObjectBase {

  /**
   * @var BranchList
   */
  protected $branches;

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
  protected $id;

  /**
   * @var string
   */
  protected $name;

  /**
   * @var string
   */
  protected $preview_embed_code;

  /**
   * @var PublishRequest
   */
  protected $publish_request;

  /**
   * @var string
   */
  protected $preview_url;

  /**
   * @var string
   */
  protected $repository_url;

  /**
   * @var string
   */
  protected $url;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'branches', NULL, BranchList::class);
    $this->applyProperty($json, 'embed_code');
    $this->applyProperty($json, 'embed_in_page');
    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'name');
    $this->applyProperty($json, 'preview_embed_code');
    $this->applyProperty($json, 'publish_request', NULL, PublishRequest::class);
    $this->applyProperty($json, 'preview_url');
    $this->applyProperty($json, 'repository_url');
    $this->applyProperty($json, 'url');
  }

  /**
   * @return \Brightcove\Object\Player\Branch\BranchList
   */
  public function getBranches() {
    return $this->branches;
  }

  /**
   * @param \Brightcove\Object\Player\Branch\BranchList $branches
   *
   * @return Embed
   */
  public function setBranches($branches) {
    $this->branches = $branches;
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
   *
   * @return Embed
   */
  public function setEmbedCode($embed_code) {
    $this->embed_code = $embed_code;
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
   *
   * @return Embed
   */
  public function setEmbedInPage($embed_in_page) {
    $this->embed_in_page = $embed_in_page;
    return $this;
  }

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   *
   * @return Embed
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param string $name
   *
   * @return Embed
   */
  public function setName($name) {
    $this->name = $name;
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
   *
   * @return Embed
   */
  public function setPreviewEmbedCode($preview_embed_code) {
    $this->preview_embed_code = $preview_embed_code;
    return $this;
  }

  /**
   * @return \Brightcove\Object\Player\Embed\PublishRequest
   */
  public function getPublishRequest() {
    return $this->publish_request;
  }

  /**
   * @param \Brightcove\Object\Player\Embed\PublishRequest $publish_request
   *
   * @return Embed
   */
  public function setPublishRequest($publish_request) {
    $this->publish_request = $publish_request;
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
   *
   * @return Embed
   */
  public function setPreviewUrl($preview_url) {
    $this->preview_url = $preview_url;
    return $this;
  }

  /**
   * @return string
   */
  public function getRepositoryUrl() {
    return $this->repository_url;
  }

  /**
   * @param string $repository_url
   *
   * @return Embed
   */
  public function setRepositoryUrl($repository_url) {
    $this->repository_url = $repository_url;
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
   *
   * @return Embed
   */
  public function setUrl($url) {
    $this->url = $url;
    return $this;
  }

}
