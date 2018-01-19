<?php

namespace Brightcove\API\Exception;

/**
 * Class APIException
 *
 * @package Brightcove\API\Exception
 * @api
 */
class APIException extends \Exception {
  protected $responseBody;

  /**
   * @return string
   */
  public function getResponseBody() {
    return $this->responseBody;
  }

  /**
   * @param string $responseBody
   * @return APIException
   */
  public function setResponseBody($responseBody) {
    $this->responseBody = $responseBody;
    return $this;
  }

  /**
   * @param string $message
   * @param int $code
   * @param \Exception $previous
   * @param string $responseBody
   */
  public function __construct($message = "", $code = 0, \Exception $previous = NULL, $responseBody = '') {
    parent::__construct($message, $code, $previous);
    $this->setResponseBody($responseBody);
  }
}
