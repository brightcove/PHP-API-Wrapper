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
    $args = [];
    if ($search !== NULL) {
      $args['q'] = $search;
    }
    if ($sort !== NULL) {
      $args['sort'] = $sort;
    }
    if ($limit !== NULL) {
      $args['limit'] = $limit;
    }
    if ($offset !== NULL) {
      $args['offset'] = $offset;
    }
    $query = count($args) > 0 ? '?' . http_build_query($args) : '';
    return $this->cmsRequest('GET', "/videos{$query}", 'BrightcoveVideo');
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

  /**
   * @return BrightcoveVideo
   */
  public function updateVideo(BrightcoveVideo $video) {
    return $this->cmsRequest('PATCH', "/videos/{$video->getId()}", new BrightcoveVideo(), $video);
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
   * @return $this
   */
  public function setId($id) {
    $this->id = $id;
    $this->fieldChanged('id');
    return $this;
  }

  /**
   * @return string
   */
  public function getAccountId() {
    return $this->account_id;
  }

  /**
   * @param string $account_id
   * @return $this
   */
  public function setAccountId($account_id) {
    $this->account_id = $account_id;
    $this->fieldChanged('account_id');
    return $this;
  }

  /**
   * @return string
   */
  public function getComplete() {
    return $this->complete;
  }

  /**
   * @param string $complete
   * @return $this
   */
  public function setComplete($complete) {
    $this->complete = $complete;
    $this->fieldChanged('complete');
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
   * @return $this
   */
  public function setCreatedAt($created_at) {
    $this->created_at = $created_at;
    $this->fieldChanged('created_at');
    return $this;
  }

  /**
   * @return BrightcoveVideoCuePoint[]
   */
  public function getCuePoints() {
    return $this->cue_points;
  }

  /**
   * @param BrightcoveVideoCuePoint[] $cue_points
   * @return $this
   */
  public function setCuePoints(array $cue_points) {
    $this->cue_points = $cue_points;
    $this->fieldChanged('cue_points');
    return $this;
  }

  /**
   * @return string
   */
  public function getCustomFields() {
    return $this->custom_fields;
  }

  /**
   * @param string $custom_fields
   * @return $this
   */
  public function setCustomFields($custom_fields) {
    $this->custom_fields = $custom_fields;
    $this->fieldChanged('custom_fields');
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
   * @return $this
   */
  public function setDescription($description) {
    $this->description = $description;
    $this->fieldChanged('description');
    return $this;
  }

  /**
   * @return string
   */
  public function getDuration() {
    return $this->duration;
  }

  /**
   * @param string $duration
   * @return $this
   */
  public function setDuration($duration) {
    $this->duration = $duration;
    $this->fieldChanged('duration');
    return $this;
  }

  /**
   * @return string
   */
  public function getEconomics() {
    return $this->economics;
  }

  /**
   * @param string $economics
   * @return $this
   */
  public function setEconomics($economics) {
    $this->economics = $economics;
    $this->fieldChanged('economics');
    return $this;
  }

  /**
   * @return string
   */
  public function getFolderId() {
    return $this->folder_id;
  }

  /**
   * @param string $folder_id
   * @return $this
   */
  public function setFolderId($folder_id) {
    $this->folder_id = $folder_id;
    $this->fieldChanged('folder_id');
    return $this;
  }

  /**
   * @return BrightcoveVideoGEO
   */
  public function getGeo() {
    return $this->geo;
  }

  /**
   * @param BrightcoveVideoGEO $geo
   * @return $this
   */
  public function setGeo(BrightcoveVideoGEO $geo = NULL) {
    $this->geo = $geo;
    $this->fieldChanged('geo');
    return $this;
  }

  /**
   * @return BrightcoveVideoImage[]
   */
  public function getImages() {
    return $this->images;
  }

  /**
   * @param BrightcoveVideoImage[] $images
   * @return $this
   */
  public function setImages(array $images) {
    $this->images = $images;
    $this->fieldChanged('images');
    return $this;
  }

  /**
   * @return string
   */
  public function getLink() {
    return $this->link;
  }

  /**
   * @param string $link
   * @return $this
   */
  public function setLink($link) {
    $this->link = $link;
    $this->fieldChanged('link');
    return $this;
  }

  /**
   * @return string
   */
  public function getLongDescription() {
    return $this->long_description;
  }

  /**
   * @param string $long_description
   * @return $this
   */
  public function setLongDescription($long_description) {
    $this->long_description = $long_description;
    $this->fieldChanged('long_description');
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
  public function getReferenceId() {
    return $this->reference_id;
  }

  /**
   * @param string $reference_id
   * @return $this
   */
  public function setReferenceId($reference_id) {
    $this->reference_id = $reference_id;
    $this->fieldChanged('reference_id');
    return $this;
  }

  /**
   * @return BrightcoveVideoSchedule
   */
  public function getSchedule() {
    return $this->schedule;
  }

  /**
   * @param BrightcoveVideoSchedule $schedule
   * @return $this
   */
  public function setSchedule(BrightcoveVideoSchedule $schedule = NULL) {
    $this->schedule = $schedule;
    $this->fieldChanged('schedule');
    return $this;
  }

  /**
   * @return string
   */
  public function getSharing() {
    return $this->sharing;
  }

  /**
   * @param string $sharing
   * @return $this
   */
  public function setSharing($sharing) {
    $this->sharing = $sharing;
    $this->fieldChanged('sharing');
    return $this;
  }

  /**
   * @return string
   */
  public function getState() {
    return $this->state;
  }

  /**
   * @param string $state
   * @return $this
   */
  public function setState($state) {
    $this->state = $state;
    $this->fieldChanged('state');
    return $this;
  }

  /**
   * @return array
   */
  public function getTags() {
    return $this->tags;
  }

  /**
   * @param array $tags
   * @return $this
   */
  public function setTags(array $tags) {
    $this->tags = $tags;
    $this->fieldChanged('tags');
    return $this;
  }

  /**
   * @return string
   */
  public function getTextTracks() {
    return $this->text_tracks;
  }

  /**
   * @param string $text_tracks
   * @return $this
   */
  public function setTextTracks($text_tracks) {
    $this->text_tracks = $text_tracks;
    $this->fieldChanged('text_tracks');
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
   * @return $this
   */
  public function setUpdatedAt($updated_at) {
    $this->updated_at = $updated_at;
    $this->fieldChanged('updated_at');
    return $this;
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
   * @return $this
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
   * @return $this
   */
  public function setSrc($src) {
    $this->src = $src;
    $this->fieldChanged('src');
    return $this;
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
   * @return $this
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
   * @return $this
   */
  public function setCountries($countries) {
    $this->countries = $countries;
    $this->fieldChanged('countries');
    return $this;
  }

  /**
   * @return boolean
   */
  public function isExcludeCountries() {
    return $this->exclude_countries;
  }

  /**
   * @param boolean $exclude_countries
   * @return $this
   */
  public function setExcludeCountries($exclude_countries) {
    $this->exclude_countries = $exclude_countries;
    $this->fieldChanged('exclude_countries');
    return $this;
  }

  /**
   * @return boolean
   */
  public function isRestricted() {
    return $this->restricted;
  }

  /**
   * @param boolean $restricted
   * @return $this
   */
  public function setRestricted($restricted) {
    $this->restricted = $restricted;
    $this->fieldChanged('restricted');
    return $this;
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
   * @return $this
   */
  public function setStartsAt($starts_at) {
    $this->starts_at = $starts_at;
    $this->fieldChanged('starts_at');
    return $this;
  }

  /**
   * @return string
   */
  public function getEndsAt() {
    return $this->ends_at;
  }

  /**
   * @param string $ends_at
   * @return $this
   */
  public function setEndsAt($ends_at) {
    $this->ends_at = $ends_at;
    $this->fieldChanged('ends_at');
    return $this;
  }
}
