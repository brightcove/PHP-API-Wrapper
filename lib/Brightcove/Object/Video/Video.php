<?php

namespace Brightcove\Object\Video;

use Brightcove\Object\ObjectBase;

/**
 * Representation of all data related to a video object.
 *
 * @api
 */
class Video extends ObjectBase {
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
   * @var CuePoint[]
   */
  protected $cue_points;
  /**
   * Map of custom field name:value pairs; only fields that have values are included.
   *
   * @var array
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
   * @var GEO[]
   */
  protected $geo;
  /**
   * List of image objects
   *
   * @var Image[]
   */
  protected $images;
  /**
   * Descript a related link.
   *
   * @var Link
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
   * @var Schedule
   */
  protected $schedule;
  /**
   * Sharing object
   *
   * @var Sharing $sharing
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
   * @var TextTrack[]
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
  /**
   * The mapping projection for 360° videos, e.g. "equirectangular"
   *
   * @var string
   */
  protected $projection;
  /**
   * ISO 8601 date-time string
   * Date-time video was published, can differ from created_at; example: "2014-12-09T06:07:11.877Z".
   *
   * @var string
   */
  protected $published_at;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'account_id');
    $this->applyProperty($json, 'complete');
    $this->applyProperty($json, 'created_at');
    $this->applyProperty($json, 'cue_points', NULL, CuePoint::class, TRUE);
    $this->applyProperty($json, 'custom_fields');
    $this->applyProperty($json, 'description');
    $this->applyProperty($json, 'duration');
    $this->applyProperty($json, 'economics');
    $this->applyProperty($json, 'folder_id');
    $this->applyProperty($json, 'geo', NULL, GEO::class);
    $this->applyProperty($json, 'images', NULL, Image::class, TRUE);
    $this->applyProperty($json, 'link', NULL, Link::class);
    $this->applyProperty($json, 'long_description');
    $this->applyProperty($json, 'name');
    $this->applyProperty($json, 'reference_id');
    $this->applyProperty($json, 'schedule', NULL, Schedule::class);
    $this->applyProperty($json, 'sharing', NULL, Sharing::class);
    $this->applyProperty($json, 'state');
    $this->applyProperty($json, 'tags');
    $this->applyProperty($json, 'text_tracks', NULL, TextTrack::class, TRUE);
    $this->applyProperty($json, 'updated_at');
    $this->applyProperty($json, 'projection');
    $this->applyProperty($json, 'published_at');
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
   * @return CuePoint[]
   */
  public function getCuePoints() {
    return $this->cue_points;
  }

  /**
   * @param CuePoint[] $cue_points
   * @return $this
   */
  public function setCuePoints(array $cue_points) {
    $this->cue_points = $cue_points;
    $this->fieldChanged('cue_points');
    return $this;
  }

  /**
   * @return array
   */
  public function getCustomFields() {
    return $this->custom_fields;
  }

  /**
   * @param array $custom_fields
   * @return $this
   */
  public function setCustomFields(array $custom_fields) {
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
   * @return GEO
   */
  public function getGeo() {
    return $this->geo;
  }

  /**
   * @param GEO $geo
   * @return $this
   */
  public function setGeo(GEO $geo = NULL) {
    $this->geo = $geo;
    $this->fieldChanged('geo');
    return $this;
  }

  /**
   * @return Image[]
   */
  public function getImages() {
    return $this->images;
  }

  /**
   * @param Image[] $images
   * @return $this
   */
  public function setImages(array $images) {
    $this->images = $images;
    $this->fieldChanged('images');
    return $this;
  }

  /**
   * @return Link $link
   */
  public function getLink() {
    return $this->link;
  }

  /**
   * @param  Link $link
   * @return $this
   */
  public function setLink(Link $link = NULL) {
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
   * @return Schedule
   */
  public function getSchedule() {
    return $this->schedule;
  }

  /**
   * @param Schedule $schedule
   * @return $this
   */
  public function setSchedule(Schedule $schedule = NULL) {
    $this->schedule = $schedule;
    $this->fieldChanged('schedule');
    return $this;
  }

  /**
   * @return Sharing
   */
  public function getSharing() {
    return $this->sharing;
  }

  /**
   * @param Sharing $sharing
   * @return $this
   */
  public function setSharing(Sharing $sharing = NULL) {
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
   * @return TextTrack[]
   */
  public function getTextTracks() {
    return $this->text_tracks;
  }

  /**
   * @param TextTrack[] $text_tracks
   * @return $this
   */
  public function setTextTracks(array $text_tracks) {
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

  /**
   * @return string
   */
  public function getProjection() {
    return $this->projection;
  }

  /**
   * @param string $projection
   * @return $this
   */
  public function setProjection($projection) {
    $this->projection = $projection;
    $this->fieldChanged('projection');
    return $this;
  }

  /**
   * @return string
   */
  public function getPublishedAt() {
    return $this->published_at;
  }

  /**
   * @param string $published_at
   * @return $this
   */
  public function setPublishedAt($published_at) {
    $this->published_at = $published_at;
    $this->fieldChanged('published_at');
    return $this;
  }
}
