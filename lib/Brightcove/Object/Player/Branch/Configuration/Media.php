<?php

namespace Brightcove\Object\Player\Branch\Configuration;

use Brightcove\Object\ObjectBase;

class Media extends ObjectBase {
  /**
   * @var string
   */
  protected $name;

  /**
   * @var string[]
   */
  protected $poster;

  /**
   * @var MediaSource[]
   */
  protected $sources;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'name');
    $this->applyProperty($json, 'poster');
    $this->applyProperty($json, 'sources', NULL, MediaSource::class, TRUE);
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param string $name
   * @return Media
   */
  public function setName($name) {
    $this->name = $name;
    $this->fieldChanged('name');
    return $this;
  }

  /**
   * @return array
   */
  public function getPoster() {
    return $this->poster;
  }

  /**
   * @param array $poster
   * @return Media
   */
  public function setPoster(array $poster) {
    $this->poster = $poster;
    $this->fieldChanged('poster');
    return $this;
  }

  /**
   * @return MediaSource[]
   */
  public function getSources() {
    return $this->sources;
  }

  /**
   * @param MediaSource[] $sources
   * @return Media
   */
  public function setSources(array $sources) {
    $this->sources = $sources;
    $this->fieldChanged('sources');
    return $this;
  }
}
