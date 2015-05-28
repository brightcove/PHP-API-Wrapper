<?php

namespace Brightcove\Object\Player\Branch\Configuration;

use Brightcove\Object\ObjectBase;

class Player extends ObjectBase {
  /**
   * @var PlayerTemplate
   */
  protected $template;

  /**
   * @var bool
   */
  protected $autoplay;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'template', NULL, PlayerTemplate::class);
    $this->applyProperty($json, 'autoplay');
  }

  /**
   * @return PlayerTemplate
   */
  public function getTemplate() {
    return $this->template;
  }

  /**
   * @param PlayerTemplate $template
   * @return Player
   */
  public function setTemplate(PlayerTemplate $template) {
    $this->template = $template;
    $this->fieldChanged('template');
    return $this;
  }

  /**
   * @return boolean
   */
  public function isAutoplay() {
    return $this->autoplay;
  }

  /**
   * @param boolean $autoplay
   * @return Player
   */
  public function setAutoplay($autoplay) {
    $this->autoplay = $autoplay;
    $this->fieldChanged('autoplay');
    return $this;
  }
}
