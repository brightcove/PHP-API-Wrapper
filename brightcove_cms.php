<?php

require_once 'brightcove.php';

class BrightcoveCMS extends BrightcoveAPI {

  protected function cmsRequest($method, $endpoint, $result, $post = NULL) {
    return $this->client->request($method, 'cms', $this->account, $endpoint, $result, $post);
  }

  /**
   * @return BrightcoveVideo[]
   */
  public function listVideos($search = NULL, $sort = NULL, $limit = NULL, $offset = NULL) {
    return $this->cmsRequest('GET', '/videos', 'BrightcoveVideo');
  }

  /**
   * @return BrightcoveVideo
   */
  public function getVideo($video_id) {
    return $this->cmsRequest('GET', "/videos/{$video_id}", new BrightcoveVideo());
  }

  /**
   * @return BrightcoveVideo
   */
  public function createVideo(BrightcoveVideo $video) {
    return $this->cmsRequest('POST', '/videos', new BrightcoveVideo(), $video);
  }

  public function updateVideo(BrightcoveVideo $video) {
    return $this->cmsRequest('PATCH', "/videos/{$video->getId()}", NULL, $video);
  }

  public function deleteVideo($video_id) {
    return $this->cmsRequest('DELETE', "/videos/{$video_id}", NULL);
  }

}

class BrightcoveVideo extends BrightcoveObjectBase {
  protected $id;
  protected $account_id;
  protected $complete;
  protected $created_at;
  /**
   * @var BrightcoveVideoCuePoint[]
   */
  protected $cue_points;
  protected $custom_fields;
  protected $description;
  protected $duration;
  protected $economics;
  protected $folder_id;
  /**
   * @var BrightcoveVideoGEO
   */
  protected $geo;
  /**
   * @var BrightcoveVideoImage[]
   */
  protected $images;
  protected $link;
  protected $long_description;
  protected $name;
  protected $reference_id;
  /**
   * @var BrightcoveVideoSchedule
   */
  protected $schedule;
  protected $sharing;
  protected $state;
  protected $tags;
  protected $text_tracks;
  protected $updated_at;

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * @return string
   */
  public function getAccountId() {
    return $this->account_id;
  }

  /**
   * @param string $account_id
   */
  public function setAccountId($account_id) {
    $this->account_id = $account_id;
  }

  /**
   * @return string
   */
  public function getComplete() {
    return $this->complete;
  }

  /**
   * @param string $complete
   */
  public function setComplete($complete) {
    $this->complete = $complete;
  }

  /**
   * @return string
   */
  public function getCreatedAt() {
    return $this->created_at;
  }

  /**
   * @param string $created_at
   */
  public function setCreatedAt($created_at) {
    $this->created_at = $created_at;
  }

  /**
   * @return BrightcoveVideoCuePoint[]
   */
  public function getCuePoints() {
    return $this->cue_points;
  }

  /**
   * @param BrightcoveVideoCuePoint[] $cue_points
   */
  public function setCuePoints(array $cue_points) {
    $this->cue_points = $cue_points;
  }

  /**
   * @return string
   */
  public function getCustomFields() {
    return $this->custom_fields;
  }

  /**
   * @param string $custom_fields
   */
  public function setCustomFields($custom_fields) {
    $this->custom_fields = $custom_fields;
  }

  /**
   * @return string
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * @param string $description
   */
  public function setDescription($description) {
    $this->description = $description;
  }

  /**
   * @return string
   */
  public function getDuration() {
    return $this->duration;
  }

  /**
   * @param string $duration
   */
  public function setDuration($duration) {
    $this->duration = $duration;
  }

  /**
   * @return string
   */
  public function getEconomics() {
    return $this->economics;
  }

  /**
   * @param string $economics
   */
  public function setEconomics($economics) {
    $this->economics = $economics;
  }

  /**
   * @return string
   */
  public function getFolderId() {
    return $this->folder_id;
  }

  /**
   * @param string $folder_id
   */
  public function setFolderId($folder_id) {
    $this->folder_id = $folder_id;
  }

  /**
   * @return BrightcoveVideoGEO
   */
  public function getGeo() {
    return $this->geo;
  }

  /**
   * @param BrightcoveVideoGEO $geo
   */
  public function setGeo(BrightcoveVideoGEO $geo = NULL) {
    $this->geo = $geo;
  }

  /**
   * @return BrightcoveVideoImage[]
   */
  public function getImages() {
    return $this->images;
  }

  /**
   * @param BrightcoveVideoImage[] $images
   */
  public function setImages(array $images) {
    $this->images = $images;
  }

  /**
   * @return string
   */
  public function getLink() {
    return $this->link;
  }

  /**
   * @param string $link
   */
  public function setLink($link) {
    $this->link = $link;
  }

  /**
   * @return string
   */
  public function getLongDescription() {
    return $this->long_description;
  }

  /**
   * @param string $long_description
   */
  public function setLongDescription($long_description) {
    $this->long_description = $long_description;
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param string $name
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * @return string
   */
  public function getReferenceId() {
    return $this->reference_id;
  }

  /**
   * @param string $reference_id
   */
  public function setReferenceId($reference_id) {
    $this->reference_id = $reference_id;
  }

  /**
   * @return BrightcoveVideoSchedule
   */
  public function getSchedule() {
    return $this->schedule;
  }

  /**
   * @param BrightcoveVideoSchedule $schedule
   */
  public function setSchedule(BrightcoveVideoSchedule $schedule = NULL) {
    $this->schedule = $schedule;
  }

  /**
   * @return string
   */
  public function getSharing() {
    return $this->sharing;
  }

  /**
   * @param string $sharing
   */
  public function setSharing($sharing) {
    $this->sharing = $sharing;
  }

  /**
   * @return string
   */
  public function getState() {
    return $this->state;
  }

  /**
   * @param string $state
   */
  public function setState($state) {
    $this->state = $state;
  }

  /**
   * @return array
   */
  public function getTags() {
    return $this->tags;
  }

  /**
   * @param array $tags
   */
  public function setTags(array $tags) {
    $this->tags = $tags;
  }

  /**
   * @return string
   */
  public function getTextTracks() {
    return $this->text_tracks;
  }

  /**
   * @param string $text_tracks
   */
  public function setTextTracks($text_tracks) {
    $this->text_tracks = $text_tracks;
  }

  /**
   * @return string
   */
  public function getUpdatedAt() {
    return $this->updated_at;
  }

  /**
   * @param string $updated_at
   */
  public function setUpdatedAt($updated_at) {
    $this->updated_at = $updated_at;
  }
}

class BrightcoveVideoImage extends BrightcoveObjectBase {
  protected $id;

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * @return string
   */
  public function getSrc() {
    return $this->src;
  }

  /**
   * @param string $src
   */
  public function setSrc($src) {
    $this->src = $src;
  }
  protected $src;
}

class BrightcoveVideoCuePoint extends BrightcoveObjectBase {
  protected $id;
  protected $name;
  protected $type;
  protected $time;
  protected $metadata;
  protected $force_stop;

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param string $name
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * @return string
   */
  public function getType() {
    return $this->type;
  }

  /**
   * @param string $type
   */
  public function setType($type) {
    $this->type = $type;
  }

  /**
   * @return string
   */
  public function getTime() {
    return $this->time;
  }

  /**
   * @param string $time
   */
  public function setTime($time) {
    $this->time = $time;
  }

  /**
   * @return string
   */
  public function getMetadata() {
    return $this->metadata;
  }

  /**
   * @param string $metadata
   */
  public function setMetadata($metadata) {
    $this->metadata = $metadata;
  }

  /**
   * @return string
   */
  public function getForceStop() {
    return $this->force_stop;
  }

  /**
   * @param string $force_stop
   */
  public function setForceStop($force_stop) {
    $this->force_stop = $force_stop;
  }
}

class BrightcoveVideoGEO extends BrightcoveObjectBase {
  protected $countries = [];
  protected $exclude_countries = FALSE;
  protected $restricted = FALSE;

  /**
   * @return array
   */
  public function getCountries() {
    return $this->countries;
  }

  /**
   * @param array $countries
   */
  public function setCountries($countries) {
    $this->countries = $countries;
  }

  /**
   * @return boolean
   */
  public function isExcludeCountries() {
    return $this->exclude_countries;
  }

  /**
   * @param boolean $exclude_countries
   */
  public function setExcludeCountries($exclude_countries) {
    $this->exclude_countries = $exclude_countries;
  }

  /**
   * @return boolean
   */
  public function isRestricted() {
    return $this->restricted;
  }

  /**
   * @param boolean $restricted
   */
  public function setRestricted($restricted) {
    $this->restricted = $restricted;
  }
}

class BrightcoveVideoSchedule extends BrightcoveObjectBase {
  protected $starts_at;
  protected $ends_at;

  /**
   * @return string
   */
  public function getStartsAt() {
    return $this->starts_at;
  }

  /**
   * @param string $starts_at
   */
  public function setStartsAt($starts_at) {
    $this->starts_at = $starts_at;
  }

  /**
   * @return string
   */
  public function getEndsAt() {
    return $this->ends_at;
  }

  /**
   * @param string $ends_at
   */
  public function setEndsAt($ends_at) {
    $this->ends_at = $ends_at;
  }
}
