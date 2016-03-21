<?php

namespace Brightcove\Object\Player\Branch\Configuration;

use Brightcove\Object\ObjectBase;

class Configuration extends ObjectBase {

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
   * @var bool
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

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'css', NULL, CSS::class);
    $this->applyProperty($json, 'media', NULL, Media::class);
    $this->applyProperty($json, 'player', NULL, Player::class);
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
   * @return boolean
   */
  public function isSkin() {
    return $this->skin;
  }

  /**
   * @param boolean $skin
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
}
