<?php

namespace Brightcove\Object\Player;

use Brightcove\Object\Player\Branch\Configuration\Configuration;

/**
 * Class CreateData
 *
 * @package Brightcove\Object\Player
 * @api
 */
class CreateData extends UpdateData {

  /**
   * @var Configuration
   */
  protected $configuration;

  /**
   * {@inheritdoc}
   */
  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'configuration', NULL, Configuration::class);
  }

  /**
   * @return \Brightcove\Object\Player\Branch\Configuration\Configuration
   */
  public function getConfiguration() {
    return $this->configuration;
  }

  /**
   * @param \Brightcove\Object\Player\Branch\Configuration\Configuration $configuration
   *
   * @return CreateData
   */
  public function setConfiguration(Configuration $configuration) {
    $this->configuration = $configuration;
    $this->fieldChanged('configuration');
    return $this;
  }

}
