<?php

require_once 'brightcove.php';

class BrightcoveCMS extends BrightcoveAPI {

  protected function cmsRequest($method, $endpoint, $result, $is_array = FALSE, $post = NULL) {
    return $this->client->request($method, 'cms', $this->account, $endpoint, $result, $is_array, $post);
  }

  /**
   * @return BrightcoveVideo[]
   */
  public function listVideos($search = NULL, $sort = NULL, $limit = NULL, $offset = NULL) {
    $query = '';
    if ($search) {
      $query .= "&q={$search}";
    }
    if ($sort) {
      $query .= "&sort={$sort}";
    }
    if ($limit) {
      $query .= "&limit={$limit}";
    }
    if ($offset) {
      $query .= "&offset={$offset}";
    }
    if (strlen($query) > 0) {
      $query = '?' . substr($query, 1);
    }
    return $this->cmsRequest('GET', "/videos{$query}", 'BrightcoveVideo', TRUE);
  }

  /**
   * @return int|null
   */
  public function countVideos($search = NULL) {
    $query = $search === NULL ? '' : "?q={$search}";
    $result = $this->cmsRequest('GET', "/counts/videos{$query}", NULL);
    if ($result && !empty($result['count'])) {
      return $result['count'];
    }
    return NULL;
  }

  /**
   * @return BrightcoveVideoImages
   */
  public function getVideoImages($video_id) {
    return $this->cmsRequest('GET', "/videos/{$video_id}/images", 'BrightcoveVideoImages');
  }

  /**
   * @return BrightcoveVideoSource[]
   */
  public function getVideoSources($video_id) {
    return $this->cmsRequest('GET', "/videos/{$video_id}/sources", 'BrightcoveVideoSource', TRUE);
  }

  /**
   * @return BrightcoveVideo
   */
  public function getVideo($video_id) {
    return $this->cmsRequest('GET', "/videos/{$video_id}", 'BrightcoveVideo');
  }

  /**
   * @return BrightcoveVideo
   */
  public function createVideo(BrightcoveVideo $video) {
    return $this->cmsRequest('POST', '/videos', 'BrightcoveVideo', FALSE, $video);
  }

  /**
   * @return BrightcoveVideo
   */
  public function updateVideo(BrightcoveVideo $video) {
    return $this->cmsRequest('PATCH', "/videos/{$video->getId()}", 'BrightcoveVideo', FALSE, $video);
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

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'account_id');
    $this->applyProperty($json, 'complete');
    $this->applyProperty($json, 'created_at');
    $this->applyProperty($json, 'cue_points', NULL, 'BrightcoveVideoCuePoint', TRUE);
    $this->applyProperty($json, 'custom_fields');
    $this->applyProperty($json, 'description');
    $this->applyProperty($json, 'duration');
    $this->applyProperty($json, 'economics');
    $this->applyProperty($json, 'folder_id');
    $this->applyProperty($json, 'geo', NULL, 'BrightcoveVideoGEO');
    $this->applyProperty($json, 'images', NULL, 'BrightcoveVideoImage', TRUE);
    $this->applyProperty($json, 'link');
    $this->applyProperty($json, 'long_description');
    $this->applyProperty($json, 'name');
    $this->applyProperty($json, 'reference_id');
    $this->applyProperty($json, 'schedule', NULL, 'BrightcoveVideoSchedule');
    $this->applyProperty($json, 'sharing');
    $this->applyProperty($json, 'state');
    $this->applyProperty($json, 'tags');
    $this->applyProperty($json, 'text_tracks');
    $this->applyProperty($json, 'updated_at');
  }

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
  protected $src;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'src');
  }

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
}

class BrightcoveVideoCuePoint extends BrightcoveObjectBase {
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

class BrightcoveVideoGEO extends BrightcoveObjectBase {
  protected $countries = [];
  protected $exclude_countries = FALSE;
  protected $restricted = FALSE;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'countries');
    $this->applyProperty($json, 'exclude_countries');
    $this->applyProperty($json, 'restricted');
  }

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

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'starts_at');
    $this->applyProperty($json, 'ends_at');
  }

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

class BrightcoveVideoImages extends BrightcoveObjectBase {
  /**
   * @var BrightcoveVideoImage
   */
  protected $thumbnail;

  /**
   * @var BrightcoveVideoImage
   */
  protected $poster;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'thumbnail');
    $this->applyProperty($json, 'poster');
  }

  /**
   * @return BrightcoveVideoImage
   */
  public function getThumbnail() {
    return $this->thumbnail;
  }

  /**
   * @param BrightcoveVideoImage $thumbnail
   * @return $this
   */
  public function setThumbnail($thumbnail) {
    $this->thumbnail = $thumbnail;
    $this->fieldChanged('thumbnail');
    return $this;
  }

  /**
   * @return BrightcoveVideoImage
   */
  public function getPoster() {
    return $this->poster;
  }

  /**
   * @param BrightcoveVideoImage $poster
   * @return $this
   */
  public function setPoster($poster) {
    $this->poster = $poster;
    $this->fieldChanged('poster');
    return $this;
  }

}

class BrightcoveVideoSource extends BrightcoveObjectBase {
  /**
   * @var string
   */
  protected $id;

  /**
   * @var string
   */
  protected $app_name;

  /**
   * @var string
   */
  protected $stream_name;

  /**
   * @var string
   */
  protected $codec;

  /**
   * @var string
   */
  protected $container;

  /**
   * @var int
   */
  protected $encoding_rate;

  /**
   * @var int
   */
  protected $duration;

  /**
   * @var int
   */
  protected $height;

  /**
   * @var int
   */
  protected $width;

  /**
   * @var int
   */
  protected $size;

  /**
   * @var string
   */
  protected $uploaded_at;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'app_name');
    $this->applyProperty($json, 'stream_name');
    $this->applyProperty($json, 'codec');
    $this->applyProperty($json, 'container');
    $this->applyProperty($json, 'encoding_rate');
    $this->applyProperty($json, 'duration');
    $this->applyProperty($json, 'height');
    $this->applyProperty($json, 'width');
    $this->applyProperty($json, 'size');
    $this->applyProperty($json, 'uploaded_at');
  }

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   * @return BrightcoveVideoSource
   */
  public function setId($id) {
    $this->id = $id;
    $this->fieldChanged('id');
    return $this;
  }

  /**
   * @return string
   */
  public function getAppName() {
    return $this->app_name;
  }

  /**
   * @param string $app_name
   * @return BrightcoveVideoSource
   */
  public function setAppName($app_name) {
    $this->app_name = $app_name;
    $this->fieldChanged('app_name');
    return $this;
  }

  /**
   * @return string
   */
  public function getStreamName() {
    return $this->stream_name;
  }

  /**
   * @param string $stream_name
   * @return BrightcoveVideoSource
   */
  public function setStreamName($stream_name) {
    $this->stream_name = $stream_name;
    $this->fieldChanged('stream_name');
    return $this;
  }

  /**
   * @return string
   */
  public function getCodec() {
    return $this->codec;
  }

  /**
   * @param string $codec
   * @return BrightcoveVideoSource
   */
  public function setCodec($codec) {
    $this->codec = $codec;
    $this->fieldChanged('codec');
    return $this;
  }

  /**
   * @return string
   */
  public function getContainer() {
    return $this->container;
  }

  /**
   * @param string $container
   * @return BrightcoveVideoSource
   */
  public function setContainer($container) {
    $this->container = $container;
    $this->fieldChanged('container');
    return $this;
  }

  /**
   * @return int
   */
  public function getEncodingRate() {
    return $this->encoding_rate;
  }

  /**
   * @param int $encoding_rate
   * @return BrightcoveVideoSource
   */
  public function setEncodingRate($encoding_rate) {
    $this->encoding_rate = $encoding_rate;
    $this->fieldChanged('encoding_rate');
    return $this;
  }

  /**
   * @return int
   */
  public function getDuration() {
    return $this->duration;
  }

  /**
   * @param int $duration
   * @return BrightcoveVideoSource
   */
  public function setDuration($duration) {
    $this->duration = $duration;
    $this->fieldChanged('duration');
    return $this;
  }

  /**
   * @return int
   */
  public function getHeight() {
    return $this->height;
  }

  /**
   * @param int $height
   * @return BrightcoveVideoSource
   */
  public function setHeight($height) {
    $this->height = $height;
    $this->fieldChanged('height');
    return $this;
  }

  /**
   * @return int
   */
  public function getWidth() {
    return $this->width;
  }

  /**
   * @param int $width
   * @return BrightcoveVideoSource
   */
  public function setWidth($width) {
    $this->width = $width;
    $this->fieldChanged('width');
    return $this;
  }

  /**
   * @return int
   */
  public function getSize() {
    return $this->size;
  }

  /**
   * @param int $size
   * @return BrightcoveVideoSource
   */
  public function setSize($size) {
    $this->size = $size;
    $this->fieldChanged('size');
    return $this;
  }

  /**
   * @return string
   */
  public function getUploadedAt() {
    return $this->uploaded_at;
  }

  /**
   * @param string $uploaded_at
   * @return BrightcoveVideoSource
   */
  public function setUploadedAt($uploaded_at) {
    $this->uploaded_at = $uploaded_at;
    $this->fieldChanged('uploaded_at');
    return $this;
  }
}
