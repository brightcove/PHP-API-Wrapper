<?php

namespace Brightcove\API\Request;

use Brightcove\Object\ObjectBase;

class SubscriptionRequest extends ObjectBase {

  /**
   * @var string
   */
  protected $endpoint;

  /**
   * @var array
   */
  protected $events;

  public function applyJSON(array $json) {
    parent::applyJSON($json);
    $this->applyProperty($json, 'endpoint');
    $this->applyProperty($json, 'events');
  }

  /**
   * @return string
   */
  public function getEndpoint() {
    return $this->endpoint;
  }

  /**
   * @param string $endpoint
   * @return SubscriptionRequest
   */
  public function setEndpoint($endpoint) {
    $this->endpoint = $endpoint;
    $this->fieldChanged('endpoint');
    return $this;
  }

  /**
   * @return array
   */
  public function getEvents() {
    return $this->events;
  }

  /**
   * @param array $events
   * @return SubscriptionRequest
   */
  public function setEvents(array $events) {
    $this->events = $events;
    $this->fieldChanged('events');
    return $this;
  }

}
