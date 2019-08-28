<?php

namespace Brightcove\Item\Player;

use Brightcove\Item\ObjectBase;

/**
 * Class EmbedList
 *
 * @package Brightcove\Item\Player
 * @api
 */
class EmbedList extends ObjectBase {

  /**
   * @var Embed[]
   */
  protected $items;

  /**
   * @var int
   */
  protected $item_count;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'items', NULL, Embed::class, TRUE);
    $this->applyProperty($json, 'item_count');
  }

  /**
   * @return Embed[]
   */
  public function getItems() {
    return $this->items;
  }

  /**
   * @param Embed[] $items
   *
   * @return EmbedList
   */
  public function setItems($items) {
    $this->items = $items;
    return $this;
  }

  /**
   * @return int
   */
  public function getItemCount() {
    return $this->item_count;
  }

  /**
   * @param int $item_count
   *
   * @return EmbedList
   */
  public function setItemCount($item_count) {
    $this->item_count = $item_count;
    return $this;
  }

}
