<?php

namespace Brightcove\Object\Player\Branch\Configuration;

use Brightcove\Object\ObjectBase;

/**
 * Class Media
 *
 * @package Brightcove\Object\Player\Branch\Configuration
 * @api
 */
class Media extends ObjectBase {

  /**
   * @var string
   */
  protected $src;

  /**
   * @var string[]
   */
  protected $poster;

  /**
   * @var MediaSource[]
   */
  protected $sources;

  /**
   * @var Track[]
   */
  protected $tracks;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'src');
    $this->applyProperty($json, 'poster');
    $this->applyProperty($json, 'sources', NULL, MediaSource::class, TRUE);
    $this->applyProperty($json, 'tracks', NULL, Track::class, TRUE);
  }

  /**
   * @return string
   */
  public function getSrc() {
    return $this->src;
  }

  /**
   * @param string $src
   *
   * @return Media
   */
  public function setSrc($src) {
    $this->src = $src;
    $this->fieldChanged('name');
    return $this;
  }

  /**
   * @return array
   */
  public function getPoster() {
    return $this->poster;
  }

  /**
   * @param array $poster
   * @return Media
   */
  public function setPoster(array $poster) {
    $this->poster = $poster;
    $this->fieldChanged('poster');
    return $this;
  }

  /**
   * @return MediaSource[]
   */
  public function getSources() {
    return $this->sources;
  }

  /**
   * @param MediaSource[] $sources
   * @return Media
   */
  public function setSources(array $sources) {
    $this->sources = $sources;
    $this->fieldChanged('sources');
    return $this;
  }

  /**
   * @return Track[]
   */
  public function getTracks() {
    return $this->tracks;
  }

  /**
   * @param Track[] $tracks
   *
   * @return Media
   */
  public function setTracks($tracks) {
    $this->tracks = $tracks;
    return $this;
  }

}
