<?php

require_once 'brightcove.php';

/**
  * This class provides uncached read access to the data via request functions.
 */
class BrightcoveCMS extends BrightcoveAPI {

  protected function cmsRequest($method, $endpoint, $result, $is_array = FALSE, $post = NULL) {
    return $this->client->request($method, 'cms', $this->account, $endpoint, $result, $is_array, $post);
  }

  /**
   * Lists video objects with the given restrictions.
   *
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
    return $this->cmsRequest('GET', "/videos{$query}", BrightcoveVideo::class, TRUE);
  }

  /**
   * Returns the amount of a searched video's result.
   *
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
   * Gets the images for a single video.
   *
   * @return BrightcoveVideoImages
   */
  public function getVideoImages($video_id) {
    return $this->cmsRequest('GET', "/videos/{$video_id}/images", BrightcoveVideoImages::class);
  }

  /**
   * Gets the sources for a single video.
   *
   * @return BrightcoveVideoSource[]
   */
  public function getVideoSources($video_id) {
    return $this->cmsRequest('GET', "/videos/{$video_id}/sources", BrightcoveVideoSource::class, TRUE);
  }

  public function getVideoFields() {
    return $this->cmsRequest('GET', "/video_fields", BrightcoveCustomFields::class, FALSE);
  }

  /**
   * Gets the data for a single video by issuing a GET request.
   *
   * @return BrightcoveVideo $video
   */
  public function getVideo($video_id) {
    return $this->cmsRequest('GET', "/videos/{$video_id}", BrightcoveVideo::class);
  }

  /**
   * Creates a new video object.
   *
   * @return BrightcoveVideo $video
   */
  public function createVideo(BrightcoveVideo $video) {
    return $this->cmsRequest('POST', '/videos', BrightcoveVideo::class, FALSE, $video);
  }

  /**
   * Updates a video object with an HTTP PATCH request.
   *
   * @return BrightcoveVideo $video
   */
  public function updateVideo(BrightcoveVideo $video) {
    return $this->cmsRequest('PATCH', "/videos/{$video->getId()}", BrightcoveVideo::class, FALSE, $video);
  }

  /**
   * Deletes a video object.
   */
  public function deleteVideo($video_id) {
    return $this->cmsRequest('DELETE', "/videos/{$video_id}", NULL);
  }

  /**
   * @return int
   */
  public function countPlaylists() {
    $result = $this->cmsRequest('GET', "/counts/playlists", NULL);
    if ($result && !empty($result['count'])) {
      return $result['count'];
    }
    return NULL;
  }

  /**
   * @return BrightcovePlaylist[]
   */
  public function listPlaylists() {
    return $this->cmsRequest('GET', '/playlists', BrightcovePlaylist::class, TRUE);
  }

  /**
   * @param BrightcovePlaylist $playlist
   * @return BrightcovePlaylist
   */
  public function createPlaylist(BrightcovePlaylist $playlist) {
    return $this->cmsRequest('POST', '/playlists', BrightcovePlaylist::class, FALSE, $playlist);
  }

  /**
   * @param string $playlist_id
   * @return BrightcovePlaylist
   */
  public function getPlaylist($playlist_id) {
    return $this->cmsRequest('GET', "/playlists/{$playlist_id}", BrightcovePlaylist::class);
  }

  /**
   * @param BrightcovePlaylist $playlist
   * @return BrightcovePlaylist
   */
  public function updatePlaylist(BrightcovePlaylist $playlist) {
    return $this->cmsRequest('PATH', "/playlists/{$playlist->getId()}", BrightcovePlaylist::class, FALSE, $playlist);
  }

  /**
   * @param string $playlist_id
   */
  public function deletePlaylist($playlist_id) {
    $this->cmsRequest('DELETE', "/playlists/{$playlist_id}", NULL);
  }

  /**
   * @param string $playlist_id
   * @return int
   */
  public function getVideoCountInPlaylist($playlist_id) {
    $result = $this->cmsRequest('GET', "/counts/playlists/{$playlist_id}/videos", NULL);
    if ($result && !empty($result['count'])) {
      return $result['count'];
    }
    return NULL;
  }

  /**
   * @param string $playlist_id
   * @return BrightcoveVideo[]
   */
  public function getVideosInPlaylist($playlist_id) {
    return $this->cmsRequest('GET', "/playlists/{$playlist_id}/videos", BrightcoveVideo::class, TRUE);
  }
}

/**
 * Creates a link object which has two separeted string field.
 */
class BrightcoveVideoLink extends BrightcoveObjectBase {
  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'url');
    $this->applyProperty($json, 'text');
  }

  /**
   * Display text for the link
   *
   * @var string
   */
  protected $text;

  /**
   * URL for the link
   *
   * @var string
   */
  protected $url;

  /**
   * @return string
   */
  public function getText() {
    return $this->text;
  }

  /**
   * @param string $text
   * @return $this
   */
  public function setText($text) {
    $this->text = $text;
    $this->fieldChanged('text');
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
   * @return $this
   */
  public function setUrl($url) {
    $this->url = $url;
    $this->fieldChanged('url');
    return $this;
  }

}


/**
 * The instance of this Class contains the sharing informations of the video object.
 */
class BrightcoveVideoSharing extends BrightcoveObjectBase {

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'by_external_acct');
    $this->applyProperty($json, 'by_id');
    $this->applyProperty($json, 'source_id');
    $this->applyProperty($json, 'to_external_acct');
    $this->applyProperty($json, 'by_reference');
  }

  /**
   * True, if the video was shared from another account.
   *
   * @var boolean
   */
  protected $by_external_acct = FALSE;
  /**
   * Id of the account that shared the video.
   *
   * @var string
   */
  protected $by_id;
  /**
   * Id of the video in its original account.
   *
   * @var string
   */
  protected $source_id;
  /**
   * Whether the video is shared to another account.
   *
   * @var boolean
   */
  protected $to_external_acct = FALSE;
  /**
   * Whether the video is shared by reference.
   *
   * @var boolean
   */
  protected $by_reference = FALSE;

  /**
   * @return boolean
   */
  public function getByExternalAcct() {
    return $this->by_external_acct;
  }

  /**
   * @param boolean $by_external_acct
   * @return $this
   */
  public function setByExternalAcct($by_external_acct) {
    $this->by_external_acct = $by_external_acct;
    $this->fieldChanged('by_external_acct');
    return $this;
  }

  /**
   * @return string
   */
  public function getById() {
    return $this->by_id;
  }

  /**
   * @param string $by_id
   * @return $this
   */
  public function setById($by_id) {
    $this->by_id = $by_id;
    $this->fieldChanged('by_id');
    return $this;
  }

  /**
   * @return string
   */
  public function getSourceId() {
    return $this->source_id;
  }

  /**
   * @param string $source_id
   * @return $this
   */
  public function setSourceId($source_id) {
    $this->source_id = $source_id;
    $this->fieldChanged('source_id');
    return $this;
  }

  /**
   * @return boolean
   */
  public function getToExternalAcct() {
    return $this->to_external_acct;
  }

  /**
   * @param boolean $to_external_acct
   * @return $this
   */
  public function setToExternalAcct($to_external_acct) {
    $this->to_external_acct = $to_external_acct;
    $this->fieldChanged('to_external_acct');
    return $this;
  }

  /**
   * @return boolean
   */
  public function getByReference() {
    return $this->by_reference;
  }

  /**
   * @param boolean $by_reference
   * @return $this
   */
  public function setByReference($by_reference) {
    $this->by_reference = $by_reference;
    $this->fieldChanged('by_reference');
    return $this;
  }

}
/**
 * Representation of all data related to a video object.
 */
class BrightcoveVideo extends BrightcoveObjectBase {
  /**
   * The video id.
   *
   * @var string
   */
  protected $id;
  /**
   * The id of the account.
   *
   * @var string
   */
  protected $account_id;
  /**
   * It will be true if all processing of renditions and images is complete.
   *
   * @var boolean
   */
  protected $complete;

  /**
   * ISO 8601 date-time string
   * Date-time video was added to the account; example: "2014-12-09T06:07:11.877Z".
   *
   * @var string
   */
  protected $created_at;

  /**
   * Array of cue_point objects.
   *
   * Marker at a precise time point in the duration of a video.
   * You can use cue points to trigger mid-roll ads or
   * to separate chapters or scenes in a long-form video.
   *
   * @var BrightcoveVideoCuePoint[]
   */
  protected $cue_points;
  /**
   * Map of custom field name:value pairs; only fields that have values are included.
   *
   * @var array[]
   */
  protected $custom_fields;
  /**
   * The short description of the video - 250 single-byte characters maximum.
   *
   * @var string
   */
  protected $description;
  /**
   * Length of the video in milliseconds.
   *
   * @var int
   */
  protected $duration;
  /**
   * Indicates whether ad requests are permitted for the video.
   *
   * @var string
   */
  protected $economics;
  /**
   * This is a reference to folder fields.
   *
   * @var string
   */
  protected $folder_id;
  /**
   * If geo-restriction is enabled for the account,
   * this array will contain geo objects which represents
   * geo-restriction properties for the video
   *
   * @var BrightcoveGEO[]
   */
  protected $geo;
  /**
   * List of image objects
   *
   * @var BrightcoveVideoImage[]
   */
  protected $images;
  /**
   * Descript a related link.
   *
   * @var BrightcoveVideoLink
   */
  protected $link;
  /**
   * Maximum 5000 single-byte characters allowed.
   *
   * @var string
   */
  protected $long_description;
  /**
   * Video title - required field
   *
   * @var string
   */
  protected $name;
  /**
   * Any value that is unique within the account
   *
   * @var string
   */
  protected $reference_id;
  /**
   * @var BrightcoveVideoSchedule
   */
  protected $schedule;
  /**
   * Sharing object
   *
   * @var BrightcoveVideoSharing $sharing
   */
  protected $sharing;
  /**
   * Current status of the video: ACTIVE | INACTIVE | PENDING | DELETED.
   *
   * @var String.
   */
  protected $state;
  /**
   * Array of tags (strings) added to the video.
   *
   * @var string[].
   */
  protected $tags;
  /**
   * Array of text_track objects.
   *
   * @var text_track[].
   */
  protected $text_tracks;
  /**
   * ISO 8601 date-time string
   * date-time video was last modified.
   * Example: "2015-01-13T17:45:21.977Z"
   *
   * @var string
   */
  protected $updated_at;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'account_id');
    $this->applyProperty($json, 'complete');
    $this->applyProperty($json, 'created_at');
    $this->applyProperty($json, 'cue_points', NULL, BrightcoveVideoCuePoint::class, TRUE);
    $this->applyProperty($json, 'custom_fields');
    $this->applyProperty($json, 'description');
    $this->applyProperty($json, 'duration');
    $this->applyProperty($json, 'economics');
    $this->applyProperty($json, 'folder_id');
    $this->applyProperty($json, 'geo', NULL, BrightcoveVideoGEO::class);
    $this->applyProperty($json, 'images', NULL, BrightcoveVideoImage::class, TRUE);
    $this->applyProperty($json, 'link', NULL, BrightcoveVideoLink::class);
    $this->applyProperty($json, 'long_description');
    $this->applyProperty($json, 'name');
    $this->applyProperty($json, 'reference_id');
    $this->applyProperty($json, 'schedule', NULL, BrightcoveVideoSchedule::class);
    $this->applyProperty($json, 'sharing', NULL, BrightcoveVideoSharing::class);
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
   * @return BrightcoveVideoLink $link
   */
  public function getLink() {
    return $this->link;
  }

  /**
   * @param  BrightcoveVideoLink $link
   * @return $this
   */
  public function setLink(BrightcoveVideoLink $link = NULL) {
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
   * @return BrightCoveVideoSharing
   */
  public function getSharing() {
    return $this->sharing;
  }

  /**
   * @param BrightcoveVideoSharing $sharing
   * @return $this
   */
  public function setSharing(BrightcoveVideoSharing $sharing = NULL) {
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

/**
 * An image what represents a video, only can be thumbnail or poster.
 */
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

/**
 * This class creates marker objects for midroll ad requests or some other action to be created via the player API
 */
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

/**
 * If geo-restriction is enabled for the account,
 * this class creates geo objects.
 * This object will contain geo-restriction properties for the video.
 */
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

/**
 * Creates a schedule object, which represents when the video becomes available/unavailable
 */
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

/**
 * Provides a poster or a thumbnail preview.
 */
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

class BrightcoveCustomFields extends BrightcoveObjectBase {
  /**
   * @var int
   */
  protected $max_custom_fields;

  /**
   * @var BrightcoveCustomField[]
   */
  protected $custom_fields;

  /**
   * @var BrightcoveCustomField[]
   */
  protected $standard_fields;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'max_custom_fields');
    $this->applyProperty($json, 'custom_fields', NULL, BrightcoveCustomField::class, TRUE);
    $this->applyProperty($json, 'standard_fields', NULL, BrightcoveCustomField::class, TRUE);
  }

  /**
   * @return int
   */
  public function getMaxCustomFields() {
    return $this->max_custom_fields;
  }

  /**
   * @param int $max_custom_fields
   * @return BrightcoveCustomFields
   */
  public function setMaxCustomFields($max_custom_fields) {
    $this->max_custom_fields = $max_custom_fields;
    $this->fieldChanged('max_custom_fields');
    return $this;
  }

  /**
   * @return BrightcoveCustomField[]
   */
  public function getCustomFields() {
    return $this->custom_fields;
  }

  /**
   * @param BrightcoveCustomField[] $custom_fields
   * @return BrightcoveCustomFields
   */
  public function setCustomFields(array $custom_fields) {
    $this->custom_fields = $custom_fields;
    $this->fieldChanged('custom_fields');
    return $this;
  }

  /**
   * @return BrightcoveCustomField[]
   */
  public function getStandardFields() {
    return $this->standard_fields;
  }

  /**
   * @param BrightcoveCustomField[] $standard_fields
   * @return BrightcoveCustomFields
   */
  public function setStandardFields(array $standard_fields) {
    $this->standard_fields = $standard_fields;
    $this->fieldChanged('standard_fields');
    return $this;
  }

}

class BrightcoveCustomField extends BrightcoveObjectBase {
  /**
   * @var string
   */
  protected $id;

  /**
   * @var string
   */
  protected $display_name;

  /**
   * @var string
   */
  protected $description;

  /**
   * @var bool
   */
  protected $required;

  /**
   * @var string
   */
  protected $type;

  /**
   * @var array
   */
  protected $enum_values;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'display_name');
    $this->applyProperty($json, 'description');
    $this->applyProperty($json, 'required');
    $this->applyProperty($json, 'type');
    $this->applyProperty($json, 'enum_values');
  }

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   * @return BrightcoveCustomField
   */
  public function setId($id) {
    $this->id = $id;
    $this->fieldChanged('id');
    return $this;
  }

  /**
   * @return string
   */
  public function getDisplayName() {
    return $this->display_name;
  }

  /**
   * @param string $display_name
   * @return BrightcoveCustomField
   */
  public function setDisplayName($display_name) {
    $this->display_name = $display_name;
    $this->fieldChanged('display_name');
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
   * @return BrightcoveCustomField
   */
  public function setDescription($description) {
    $this->description = $description;
    $this->fieldChanged('description');
    return $this;
  }

  /**
   * @return boolean
   */
  public function isRequired() {
    return $this->required;
  }

  /**
   * @param boolean $required
   * @return BrightcoveCustomField
   */
  public function setRequired($required) {
    $this->required = $required;
    $this->fieldChanged('required');
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
   * @return BrightcoveCustomField
   */
  public function setType($type) {
    $this->type = $type;
    $this->fieldChanged('type');
    return $this;
  }

  /**
   * @return array
   */
  public function getEnumValues() {
    return $this->enum_values;
  }

  /**
   * @param array $enum_values
   * @return BrightcoveCustomField
   */
  public function setEnumValues(array $enum_values) {
    $this->enum_values = $enum_values;
    $this->fieldChanged('enum_values');
    return $this;
  }

}

class BrightcovePlaylist extends BrightcoveObjectBase {
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
   * @return BrightcovePlaylist
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
   * @return BrightcovePlaylist
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
   * @return BrightcovePlaylist
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
   * @return BrightcovePlaylist
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
   * @return BrightcovePlaylist
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
   * @return BrightcovePlaylist
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
   * @return BrightcovePlaylist
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
   * @return BrightcovePlaylist
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
   * @return BrightcovePlaylist
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
   * @return BrightcovePlaylist
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
   * @return BrightcovePlaylist
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
   * @return BrightcovePlaylist
   */
  public function setVideoIds(array $video_ids) {
    $this->video_ids = $video_ids;
    $this->fieldChanged('video_ids');
    return $this;
  }

}
