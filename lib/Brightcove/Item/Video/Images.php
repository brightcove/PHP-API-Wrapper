<?php

namespace Brightcove\Item\Video;

use Brightcove\Item\ItemBase;

/**
 * Provides a poster or a thumbnail preview.
 *
 * @api
 */
class Images extends ItemBase {

  /**
   * @var Image
   */
  protected $thumbnail;

  /**
   * @var Image
   */
  protected $poster;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'thumbnail');
    $this->applyProperty($json, 'poster');
  }

  /**
   * @return Image
   */
  public function getThumbnail() {
    return $this->thumbnail;
  }

  /**
   * @param Image $thumbnail
   * @return $this
   */
  public function setThumbnail(Image $thumbnail) {
    $this->thumbnail = $thumbnail;
    $this->fieldChanged('thumbnail');
    return $this;
  }

  /**
   * @return Image
   */
  public function getPoster() {
    return $this->poster;
  }

  /**
   * @param Image $poster
   * @return $this
   */
  public function setPoster(Image $poster) {
    $this->poster = $poster;
    $this->fieldChanged('poster');
    return $this;
  }

}
