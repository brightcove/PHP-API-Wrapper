<?php

namespace Brightcove\Object\Player;

use Brightcove\Object\ObjectBase;
use Brightcove\Object\Player\Branch\BranchList;

class Player extends ObjectBase {
  /**
   * @var string
   */
  protected $accountId;

  /**
   * @var BranchList
   */
  protected $branches;

  /**
   * @var string
   */
  protected $description;

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
  protected $created_at;

  /**
   * @var string
   */
  protected $url;

  /**
   * @var int
   */
  protected $embed_count;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'accountId');
    $this->applyProperty($json, 'branches', NULL, BranchList::class);
    $this->applyProperty($json, 'description');
    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'name');
    $this->applyProperty($json, 'created_at');
    $this->applyProperty($json, 'url');
    $this->applyProperty($json, 'embed_count');
  }

  /**
   * @return string
   */
  public function getAccountId() {
    return $this->accountId;
  }

  /**
   * @param string $accountId
   * @return Player
   */
  public function setAccountId($accountId) {
    $this->accountId = $accountId;
    $this->fieldChanged('accountId');
    return $this;
  }

  /**
   * @return BranchList
   */
  public function getBranches() {
    return $this->branches;
  }

  /**
   * @param BranchList $branches
   * @return Player
   */
  public function setBranches(BranchList $branches) {
    $this->branches = $branches;
    $this->fieldChanged('branches');
    return $this;
  }

  /**
   * @return string
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * @param string $description
   * @return Player
   */
  public function setDescription($description) {
    $this->description = $description;
    $this->fieldChanged('description');
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
   * @return Player
   */
  public function setId($id) {
    $this->id = $id;
    $this->fieldChanged('id');
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
   * @return Player
   */
  public function setName($name) {
    $this->name = $name;
    $this->fieldChanged('name');
    return $this;
  }

  /**
   * @return string
   */
  public function getCreatedAt() {
    return $this->created_at;
  }

  /**
   * @param string $created_at
   * @return Player
   */
  public function setCreatedAt($created_at) {
    $this->created_at = $created_at;
    $this->fieldChanged('created_at');
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
   * @return Player
   */
  public function setUrl($url) {
    $this->url = $url;
    $this->fieldChanged('url');
    return $this;
  }

  /**
   * @return int
   */
  public function getEmbedCount() {
    return $this->embed_count;
  }

  /**
   * @param int $embed_count
   * @return Player
   */
  public function setEmbedCount($embed_count) {
    $this->embed_count = $embed_count;
    $this->fieldChanged('embed_count');
    return $this;
  }
}