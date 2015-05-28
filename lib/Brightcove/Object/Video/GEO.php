<?php

namespace Brightcove\Object\Video;

use Brightcove\Object\ObjectBase;

/**
 * If geo-restriction is enabled for the account,
 * this class creates geo objects.
 * This object will contain geo-restriction properties for the video.
 */
class GEO extends ObjectBase {
  protected $countries = [];
  protected $exclude_countries = FALSE;
  protected $restricted = FALSE;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'countries');
    $this->applyProperty($json, 'exclude_countries');
    $this->applyProperty($json, 'restricted');
  }

  /**
   * @return array
   */
  public function getCountries() {
    return $this->countries;
  }

  /**
   * @param array $countries
   * @return $this
   */
  public function setCountries($countries) {
    $this->countries = $countries;
    $this->fieldChanged('countries');
    return $this;
  }

  /**
   * @return boolean
   */
  public function isExcludeCountries() {
    return $this->exclude_countries;
  }

  /**
   * @param boolean $exclude_countries
   * @return $this
   */
  public function setExcludeCountries($exclude_countries) {
    $this->exclude_countries = $exclude_countries;
    $this->fieldChanged('exclude_countries');
    return $this;
  }

  /**
   * @return boolean
   */
  public function isRestricted() {
    return $this->restricted;
  }

  /**
   * @param boolean $restricted
   * @return $this
   */
  public function setRestricted($restricted) {
    $this->restricted = $restricted;
    $this->fieldChanged('restricted');
    return $this;
  }
}