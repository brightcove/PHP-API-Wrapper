<?php

namespace Brightcove\Object;

class Playlist extends ObjectBase {
  /**
   * @var string
   */
  protected $id;

  /**
   * @var string
   */
  protected $account;

  /**
   * @var string
   */
  protected $created_at;

  /**
   * @var string
   */
  protected $description;

  /**
   * @var bool
   */
  protected $favorite;

  /**
   * @var int
   */
  protected $limit;

  /**
   * @var string
   */
  protected $name;

  /**
   * @var string
   */
  protected $reference_id;

  /**
   * @var string
   */
  protected $search;

  /**
   * @var string
   */
  protected $type;

  /**
   * @var string
   */
  protected $updated_at;

  /**
   * @var array
   */
  protected $video_ids;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'account');
    $this->applyProperty($json, 'created_at');
    $this->applyProperty($json, 'description');
    $this->applyProperty($json, 'favorite');
    $this->applyProperty($json, 'limit');
    $this->applyProperty($json, 'name');
    $this->applyProperty($json, 'reference_id');
    $this->applyProperty($json, 'search');
    $this->applyProperty($json, 'type');
    $this->applyProperty($json, 'updated_at');
    $this->applyProperty($json, 'video_ids');
  }

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   * @return Playlist
   */
  public function setId($id) {
    $this->id = $id;
    $this->fieldChanged('id');
    return $this;
  }

  /**
   * @return string
   */
  public function getAccount() {
    return $this->account;
  }

  /**
   * @param string $account
   * @return Playlist
   */
  public function setAccount($account) {
    $this->account = $account;
    $this->fieldChanged('account');
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
   * @return Playlist
   */
  public function setCreatedAt($created_at) {
    $this->created_at = $created_at;
    $this->fieldChanged('created_at');
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
   * @return Playlist
   */
  public function setDescription($description) {
    $this->description = $description;
    $this->fieldChanged('description');
    return $this;
  }

  /**
   * @return boolean
   */
  public function isFavorite() {
    return $this->favorite;
  }

  /**
   * @param boolean $favorite
   * @return Playlist
   */
  public function setFavorite($favorite) {
    $this->favorite = $favorite;
    $this->fieldChanged('favorite');
    return $this;
  }

  /**
   * @return int
   */
  public function getLimit() {
    return $this->limit;
  }

  /**
   * @param int $limit
   * @return Playlist
   */
  public function setLimit($limit) {
    $this->limit = $limit;
    $this->fieldChanged('limit');
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
   * @return Playlist
   */
  public function setName($name) {
    $this->name = $name;
    $this->fieldChanged('name');
    return $this;
  }

  /**
   * @return string
   */
  public function getReferenceId() {
    return $this->reference_id;
  }

  /**
   * @param string $reference_id
   * @return Playlist
   */
  public function setReferenceId($reference_id) {
    $this->reference_id = $reference_id;
    $this->fieldChanged('reference_id');
    return $this;
  }

  /**
   * @return string
   */
  public function getSearch() {
    return $this->search;
  }

  /**
   * @param string $search
   * @return Playlist
   */
  public function setSearch($search) {
    $this->search = $search;
    $this->fieldChanged('search');
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
   * @return Playlist
   */
  public function setType($type) {
    $this->type = $type;
    $this->fieldChanged('type');
    return $this;
  }

  /**
   * @return string
   */
  public function getUpdatedAt() {
    return $this->updated_at;
  }

  /**
   * @param string $updated_at
   * @return Playlist
   */
  public function setUpdatedAt($updated_at) {
    $this->updated_at = $updated_at;
    $this->fieldChanged('updated_at');
    return $this;
  }

  /**
   * @return array
   */
  public function getVideoIds() {
    return $this->video_ids;
  }

  /**
   * @param array $video_ids
   * @return Playlist
   */
  public function setVideoIds(array $video_ids) {
    $this->video_ids = $video_ids;
    $this->fieldChanged('video_ids');
    return $this;
  }

}
