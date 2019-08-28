<?php

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ItemBase;

/**
 * Class Player
 *
 * @package Brightcove\Item\Player\Branch\Configuration
 * @api
 */
class Player extends ItemBase {
  /**
   * @var PlayerTemplate
   */
  protected $template;

  /**
   * @var bool
   */
  protected $inactive;

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
  public function isInactive() {
    return $this->inactive;
  }

  /**
   * @param boolean $inactive
   *
   * @return Player
   */
  public function setInactive($inactive) {
    $this->inactive = $inactive;
    $this->fieldChanged('inactive');
    return $this;
  }
}
