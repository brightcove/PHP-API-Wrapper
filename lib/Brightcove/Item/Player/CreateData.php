<?php

namespace Brightcove\Item\Player;

use Brightcove\Item\Player\Branch\Configuration\Configuration;

/**
 * Class CreateData
 *
 * @package Brightcove\Item\Player
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
   * @return \Brightcove\Item\Player\Branch\Configuration\Configuration
   */
  public function getConfiguration() {
    return $this->configuration;
  }

  /**
   * @param \Brightcove\Item\Player\Branch\Configuration\Configuration $configuration
   *
   * @return CreateData
   */
  public function setConfiguration(Configuration $configuration) {
    $this->configuration = $configuration;
    $this->fieldChanged('configuration');
    return $this;
  }

}
