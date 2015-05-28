<?php

namespace Brightcove\Object\Player\Branch\Configuration;

use Brightcove\Object\ObjectBase;

class Configuration extends ObjectBase {
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

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'media', NULL, Media::class);
    $this->applyProperty($json, 'player', NULL, Player::class);
    $this->applyProperty($json, 'scripts');
    $this->applyProperty($json, 'stylesheets');
    $this->applyProperty($json, 'plugins', NULL, Plugin::class, TRUE);
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
}
