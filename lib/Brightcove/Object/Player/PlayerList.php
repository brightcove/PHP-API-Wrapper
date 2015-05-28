<?php

namespace Brightcove\Object\Player;

use Brightcove\Object\ObjectBase;

class PlayerList extends ObjectBase {
  /**
   * @var array
   */
  protected $items;

  /**
   * @var int
   */
  protected $item_count;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'items', NULL, Player::class, TRUE);
    $this->applyProperty($json, 'item_count');
  }

  /**
   * @return Player[]
   */
  public function getItems() {
    return $this->items;
  }

  /**
   * @param Player[] $items
   * @return PlayerList
   */
  public function setItems(array $items) {
    $this->items = $items;
    $this->fieldChanged('items');
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
   * @return PlayerList
   */
  public function setItemCount($item_count) {
    $this->item_count = $item_count;
    $this->fieldChanged('item_count');
    return $this;
  }
}
