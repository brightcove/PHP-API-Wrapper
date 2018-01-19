<?php

namespace Brightcove\Object\Video;

use Brightcove\Object\ObjectBase;

/**
 * The instance of this Class contains the sharing informations of the video object.
 *
 * @api
 */
class Sharing extends ObjectBase {

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'by_external_acct');
    $this->applyProperty($json, 'by_id');
    $this->applyProperty($json, 'source_id');
    $this->applyProperty($json, 'to_external_acct');
    $this->applyProperty($json, 'by_reference');
  }

  /**
   * True, if the video was shared from another account.
   *
   * @var boolean
   */
  protected $by_external_acct = FALSE;
  /**
   * Id of the account that shared the video.
   *
   * @var string
   */
  protected $by_id;
  /**
   * Id of the video in its original account.
   *
   * @var string
   */
  protected $source_id;
  /**
   * Whether the video is shared to another account.
   *
   * @var boolean
   */
  protected $to_external_acct = FALSE;
  /**
   * Whether the video is shared by reference.
   *
   * @var boolean
   */
  protected $by_reference = FALSE;

  /**
   * @return boolean
   */
  public function getByExternalAcct() {
    return $this->by_external_acct;
  }

  /**
   * @param boolean $by_external_acct
   * @return $this
   */
  public function setByExternalAcct($by_external_acct) {
    $this->by_external_acct = $by_external_acct;
    $this->fieldChanged('by_external_acct');
    return $this;
  }

  /**
   * @return string
   */
  public function getById() {
    return $this->by_id;
  }

  /**
   * @param string $by_id
   * @return $this
   */
  public function setById($by_id) {
    $this->by_id = $by_id;
    $this->fieldChanged('by_id');
    return $this;
  }

  /**
   * @return string
   */
  public function getSourceId() {
    return $this->source_id;
  }

  /**
   * @param string $source_id
   * @return $this
   */
  public function setSourceId($source_id) {
    $this->source_id = $source_id;
    $this->fieldChanged('source_id');
    return $this;
  }

  /**
   * @return boolean
   */
  public function getToExternalAcct() {
    return $this->to_external_acct;
  }

  /**
   * @param boolean $to_external_acct
   * @return $this
   */
  public function setToExternalAcct($to_external_acct) {
    $this->to_external_acct = $to_external_acct;
    $this->fieldChanged('to_external_acct');
    return $this;
  }

  /**
   * @return boolean
   */
  public function getByReference() {
    return $this->by_reference;
  }

  /**
   * @param boolean $by_reference
   * @return $this
   */
  public function setByReference($by_reference) {
    $this->by_reference = $by_reference;
    $this->fieldChanged('by_reference');
    return $this;
  }
}