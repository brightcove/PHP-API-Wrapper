<?php

namespace Brightcove\Object\Player\Branch;

use Brightcove\Object\ObjectBase;
use Brightcove\Object\Player\Branch\Configuration\Configuration;

class Branch extends ObjectBase {
  /**
   * @var Configuration
   */
  protected $configuration;

  /**
   * @var string
   */
  protected $updated_at;

  /**
   * @var string
   */
  protected $preview_url;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'configuration', NULL, Configuration::class);
    $this->applyProperty($json, 'updated_at');
    $this->applyProperty($json, 'preview_url');
  }

  /**
   * @return Configuration
   */
  public function getConfiguration() {
    return $this->configuration;
  }

  /**
   * @param Configuration $configuration
   * @return Branch
   */
  public function setConfiguration(Configuration $configuration) {
    $this->configuration = $configuration;
    $this->fieldChanged('configuration');
    return $this;
  }

  /**
   * @return string
   */
  public function getUpdatedAt() {
    return $this->updated_at;
  }

  /**
   * @param string $updated_at
   * @return Branch
   */
  public function setUpdatedAt($updated_at) {
    $this->updated_at = $updated_at;
    return $this;
  }

  /**
   * @return string
   */
  public function getPreviewUrl() {
    return $this->preview_url;
  }

  /**
   * @param string $preview_url
   * @return Branch
   */
  public function setPreviewUrl($preview_url) {
    $this->preview_url = $preview_url;
    return $this;
  }
}
