<?php

namespace Brightcove\Object\Player\Branch\Configuration;

use Brightcove\Object\ObjectBase;

/**
 * Class Configuration
 *
 * @package Brightcove\Object\Player\Branch\Configuration
 * @api
 */
class Configuration extends ObjectBase {

  /**
   * @var bool
   */
  protected $autoadvance;

  /**
   * @var bool
   */
  protected $autoplay;

  /**
   * @var CSS
   */
  protected $css;

  /**
   * @var Media
   */
  protected $media;

  /**
   * @var Player
   */
  protected $player;

  /**
   * @var bool
   */
  protected $playlist;

  /**
   * @var bool
   */
  protected $playOnSelect;

  /**
   * @var string[]
   */
  protected $scripts;

  /**
   * @var string[]
   */
  protected $stylesheets;

  /**
   * @var Plugin[]
   */
  protected $plugins;

  /**
   * @var bool
   */
  protected $errors;

  /**
   * @var bool
   */
  protected $fullscreenControl;

  /**
   * @var array
   */
  protected $languages;

  /**
   * @var bool
   */
  protected $loop;

  /**
   * @var string
   */
  protected $preload;

  /**
   * @var bool|string
   */
  protected $skin;

  /**
   * @var array
   */
  protected $techOrder;

  /**
   * @var VideoCloud
   */
  protected $video_cloud;

  /**
   * @var StudioConfiguration
   */
  protected $studio_configuration;

  protected $embed_name;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'autoadvance');
    $this->applyProperty($json, 'autoplay');
    $this->applyProperty($json, 'css', NULL, CSS::class);
    $this->applyProperty($json, 'media', NULL, Media::class);
    $this->applyProperty($json, 'player', NULL, Player::class);
    $this->applyProperty($json, 'playlist');
    $this->applyProperty($json, 'playOnSelect');
    $this->applyProperty($json, 'scripts');
    $this->applyProperty($json, 'stylesheets');
    $this->applyProperty($json, 'plugins', NULL, Plugin::class, TRUE);
    $this->applyProperty($json, 'errors');
    $this->applyProperty($json, 'fullscreenControl');
    $this->applyProperty($json, 'languages');
    $this->applyProperty($json, 'loop');
    $this->applyProperty($json, 'preload');
    $this->applyProperty($json, 'skin');
    $this->applyProperty($json, 'techOrder');
    $this->applyProperty($json, 'video_cloud', NULL, VideoCloud::class);
    $this->applyProperty($json, 'studio_configuration', NULL, StudioConfiguration::class);

    $this->applyProperty($json, 'embed_name');
  }

  public function getEmbedName() {
    return $this->embed_name;
  }

  public function setEmbedName($embed_name) {
    $this->embed_name = $embed_name;
    $this->fieldChanged('embed_name');
    return $this;
  }

  /**
   * @return CSS
   */
  public function getCss() {
    return $this->css;
  }

  /**
   * @param CSS $css
   * @return Configuration
   */
  public function setCss($css) {
    $this->css = $css;
    $this->fieldChanged('css');
    return $this;
  }

  /**
   * @return Media
   */
  public function getMedia() {
    return $this->media;
  }

  /**
   * @param Media $media
   * @return Configuration
   */
  public function setMedia(Media $media) {
    $this->media = $media;
    $this->fieldChanged('media');
    return $this;
  }

  /**
   * @return Player
   */
  public function getPlayer() {
    return $this->player;
  }

  /**
   * @param Player $player
   * @return Configuration
   */
  public function setPlayer(Player $player) {
    $this->player = $player;
    $this->fieldChanged('player');
    return $this;
  }

  /**
   * @return string[]
   */
  public function getScripts() {
    return $this->scripts;
  }

  /**
   * @param string[] $scripts
   * @return Configuration
   */
  public function setScripts(array $scripts) {
    $this->scripts = $scripts;
    $this->fieldChanged('scripts');
    return $this;
  }

  /**
   * @return string[]
   */
  public function getStylesheets() {
    return $this->stylesheets;
  }

  /**
   * @param string[] $stylesheets
   * @return Configuration
   */
  public function setStylesheets(array $stylesheets) {
    $this->stylesheets = $stylesheets;
    $this->fieldChanged('stylesheets');
    return $this;
  }

  /**
   * @return Plugin[]
   */
  public function getPlugins() {
    return $this->plugins;
  }

  /**
   * @param Plugin[] $plugins
   * @return Configuration
   */
  public function setPlugins(array $plugins) {
    $this->plugins = $plugins;
    $this->fieldChanged('plugins');
    return $this;
  }

  /**
   * @return boolean
   */
  public function isErrors() {
    return $this->errors;
  }

  /**
   * @param boolean $errors
   * @return Configuration
   */
  public function setErrors($errors) {
    $this->errors = $errors;
    $this->fieldChanged('errors');
    return $this;
  }

  /**
   * @return boolean
   */
  public function isFullscreenControl() {
    return $this->fullscreenControl;
  }

  /**
   * @param boolean $fullscreenControl
   * @return Configuration
   */
  public function setFullscreenControl($fullscreenControl) {
    $this->fullscreenControl = $fullscreenControl;
    $this->fieldChanged('fullscreenControl');
    return $this;
  }

  /**
   * @return array
   */
  public function getLanguages() {
    return $this->languages;
  }

  /**
   * @param array $languages
   * @return Configuration
   */
  public function setLanguages($languages) {
    $this->languages = $languages;
    $this->fieldChanged('languages');
    return $this;
  }

  /**
   * @return boolean
   */
  public function isLoop() {
    return $this->loop;
  }

  /**
   * @param boolean $loop
   * @return Configuration
   */
  public function setLoop($loop) {
    $this->loop = $loop;
    $this->fieldChanged('loop');
    return $this;
  }

  /**
   * @return string
   */
  public function getPreload() {
    return $this->preload;
  }

  /**
   * @param string $preload
   * @return Configuration
   */
  public function setPreload($preload) {
    $this->preload = $preload;
    $this->fieldChanged('preload');
    return $this;
  }

  /**
   * @return boolean|string
   */
  public function getSkin() {
    return $this->skin;
  }

  /**
   * @param boolean|string $skin
   * @return Configuration
   */
  public function setSkin($skin) {
    $this->skin = $skin;
    $this->fieldChanged('skin');
    return $this;
  }

  /**
   * @return array
   */
  public function getTechOrder() {
    return $this->techOrder;
  }

  /**
   * @param array $techOrder
   * @return Configuration
   */
  public function setTechOrder($techOrder) {
    $this->techOrder = $techOrder;
    $this->fieldChanged('techOrder');
    return $this;
  }

  /**
   * @return VideoCloud
   */
  public function getVideoCloud() {
    return $this->video_cloud;
  }

  /**
   * @param VideoCloud $video_cloud
   * @return Configuration
   */
  public function setVideoCloud($video_cloud) {
    $this->video_cloud = $video_cloud;
    $this->fieldChanged('video_cloud');
    return $this;
  }

  /**
   * @return StudioConfiguration
   */
  public function getStudioConfiguration() {
    return $this->studio_configuration;
  }

  /**
   * @param StudioConfiguration $studio_configuration
   * @return Configuration
   */
  public function setStudioConfiguration($studio_configuration) {
    $this->studio_configuration = $studio_configuration;
    $this->fieldChanged('studio_configuration');
    return $this;
  }

  /**
   * @return bool
   */
  public function isAutoadvance() {
    return $this->autoadvance;
  }

  /**
   * @param bool $autoadvance
   *
   * @return Configuration
   */
  public function setAutoadvance($autoadvance) {
    $this->autoadvance = $autoadvance;
    $this->fieldChanged('autoadvance');
    return $this;
  }

  /**
   * @return bool
   */
  public function isAutoplay() {
    return $this->autoplay;
  }

  /**
   * @param bool $autoplay
   *
   * @return Configuration
   */
  public function setAutoplay($autoplay) {
    $this->autoplay = $autoplay;
    $this->fieldChanged('autoplay');
    return $this;
  }

  /**
   * @return bool
   */
  public function isPlaylist() {
    return $this->playlist;
  }

  /**
   * @param bool $playlist
   *
   * @return Configuration
   */
  public function setPlaylist($playlist) {
    $this->playlist = $playlist;
    $this->fieldChanged('playlist');
    return $this;
  }

  /**
   * @return bool
   */
  public function isPlayOnSelect() {
    return $this->playOnSelect;
  }

  /**
   * @param bool $playOnSelect
   *
   * @return Configuration
   */
  public function setPlayOnSelect($playOnSelect) {
    $this->playOnSelect = $playOnSelect;
    $this->fieldChanged('playOnSelect');
    return $this;
  }

}
