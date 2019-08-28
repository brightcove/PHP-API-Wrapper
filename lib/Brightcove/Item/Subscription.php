<?php

namespace Brightcove\Item;

use Brightcove\API\Request\SubscriptionRequest;

/**
 * Class Subscription
 *
 * @package Brightcove\Item
 * @api
 */
class Subscription extends SubscriptionRequest {

  /**
   * @var string
   */
  protected $id;

  /**
   * @var string
   */
  protected $service_account;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'service_account');
  }

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   * @return Subscription
   */
  public function setId($id) {
    $this->id = $id;
    $this->fieldChanged('id');
    return $this;
  }

  /**
   * @return string
   */
  public function getServiceAccount() {
    return $this->service_account;
  }

  /**
   * @param string $service_account
   * @return Subscription
   */
  public function setServiceAccount($service_account) {
    $this->service_account = $service_account;
    $this->fieldChanged('service_account');
    return $this;
  }
}
