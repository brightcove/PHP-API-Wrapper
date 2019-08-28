<?php

namespace Brightcove\Item\Video;

use Brightcove\Item\ItemBase;

/**
 * Creates a link Item which has two separeted string field.
 *
 * @api
 */
class Link extends ItemBase {
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
