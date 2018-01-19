<?php

namespace Brightcove\Object\Player\Branch;

use Brightcove\Object\ObjectBase;
use Brightcove\Object\Player\Branch\Configuration\Configuration;

/**
 * Class Branch
 *
 * @package Brightcove\Object\Player\Branch
 * @api
 */
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
  protected $template_updated_at;

  /**
   * @var string
   */
  protected $master_url;

  /**
   * @var string
   */
  protected $preview_url;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'configuration', NULL, Configuration::class);
    $this->applyProperty($json, 'updated_at');
    $this->applyProperty($json, 'master_url');
    $this->applyProperty($json, 'template_updated_at');
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
    $this->fieldChanged('updated_at');
    return $this;
  }

  /**
   * @return string
   */
  public function getMasterUrl() {
    return $this->master_url;
  }

  /**
   * @param string $master_url
   *
   * @return Branch
   */
  public function setMasterUrl($master_url) {
    $this->master_url = $master_url;
    $this->fieldChanged('master_url');
    return $this;
  }

  /**
   * @return string
   */
  public function getTemplateUpdatedAt() {
    return $this->template_updated_at;
  }

  /**
   * @param string $template_updated_at
   *
   * @return Branch
   */
  public function setTemplateUpdatedAt($template_updated_at) {
    $this->template_updated_at = $template_updated_at;
    $this->fieldChanged('template_updated_at');
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
   *
   * @return Branch
   */
  public function setPreviewUrl($preview_url) {
    $this->preview_url = $preview_url;
    $this->fieldChanged('preview_url');
    return $this;
  }

}
