<?php

namespace Brightcove\API\Response;

use Brightcove\Object\ObjectBase;

class IngestResponse extends ObjectBase {
  protected $id;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'id');
  }

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   * @return $this
   */
  public function setId($id) {
    $this->id = $id;
    $this->fieldChanged('id');
    return $this;
  }
}