<?php

namespace Brightcove\Item\Player;

use Brightcove\Item\ItemBase;

/**
 * Class PublishComment
 *
 * @package Brightcove\Item\Player
 * @api
 */
class PublishComment extends ItemBase {
  /**
   * @var string
   */
  protected $comment;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'comment');
  }

  /**
   * @return string
   */
  public function getComment() {
    return $this->comment;
  }

  /**
   * @param string $comment
   * @return PublishComment
   */
  public function setComment($comment) {
    $this->comment = $comment;
    $this->fieldChanged('comment');
    return $this;
  }
}
