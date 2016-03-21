<?php

namespace Brightcove\Object\Player\Branch\Configuration;

use Brightcove\Object\ObjectBase;

class StudioConfiguration extends ObjectBase {

  /**
   * @var StudioConfigurationPlayer
   */
  protected $player;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'player', NULL, StudioConfigurationPlayer::class);
  }

  /**
   * @return StudioConfigurationPlayer
   */
  public function getPlayer() {
    return $this->player;
  }

  /**
   * @param StudioConfigurationPlayer $player
   * @return StudioConfiguration
   */
  public function setPlayer(StudioConfigurationPlayer $player) {
    $this->player = $player;
    $this->fieldChanged('player');
    return $this;
  }
}
