<?php

namespace Brightcove\Object\Video;

use Brightcove\Object\ObjectBase;

/**
 * Class Source
 *
 * @package Brightcove\Object\Video
 * @api
 */
class Source extends ObjectBase {
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

  /**
   * @var string
   */
  protected $src;

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
    $this->applyProperty($json, 'src');
  }

  /**
   * @return string
   */
  public function getSrc() {
    return $this->src;
  }

  /**
   * @param string $src
   * @return Source
   */
  public function setSrc($src) {
    $this->src = $src;
    $this->fieldChanged('src');
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
   * @return Source
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
   * @return Source
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
   * @return Source
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
   * @return Source
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
   * @return Source
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
   * @return Source
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
   * @return Source
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
   * @return Source
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
   * @return Source
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
   * @return Source
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
   * @return Source
   */
  public function setUploadedAt($uploaded_at) {
    $this->uploaded_at = $uploaded_at;
    $this->fieldChanged('uploaded_at');
    return $this;
  }
}
