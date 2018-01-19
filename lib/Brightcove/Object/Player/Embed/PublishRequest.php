<?php

namespace Brightcove\Object\Player\Embed;

use Brightcove\Object\ObjectBase;

/**
 * Class PublishRequest
 *
 * @package Brightcove\Object\Player\Embed
 * @api
 */
class PublishRequest extends ObjectBase {

  /**
   * @var string
   */
  protected $author;

  /**
   * @var string
   */
  protected $buildLog;

  /**
   * @var string
   */
  protected $comment;

  /**
   * @var string
   */
  protected $elapsed_time;

  /**
   * @var string
   */
  protected $errorCode;

  /**
   * @var string
   */
  protected $queue_msg_id;

  /**
   * @var string
   */
  protected $requested_at;

  /**
   * @var string
   */
  protected $retries;

  /**
   * @var string
   */
  protected $status;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'author');
    $this->applyProperty($json, 'buildLog');
    $this->applyProperty($json, 'comment');
    $this->applyProperty($json, 'elapsed_time');
    $this->applyProperty($json, 'errorCode');
    $this->applyProperty($json, 'queue_msg_id');
    $this->applyProperty($json, 'requested_at');
    $this->applyProperty($json, 'retries');
    $this->applyProperty($json, 'status');
  }

  /**
   * @return string
   */
  public function getAuthor() {
    return $this->author;
  }

  /**
   * @param string $author
   *
   * @return PublishRequest
   */
  public function setAuthor($author) {
    $this->author = $author;
    return $this;
  }

  /**
   * @return string
   */
  public function getBuildLog() {
    return $this->buildLog;
  }

  /**
   * @param string $buildLog
   *
   * @return PublishRequest
   */
  public function setBuildLog($buildLog) {
    $this->buildLog = $buildLog;
    return $this;
  }

  /**
   * @return string
   */
  public function getComment() {
    return $this->comment;
  }

  /**
   * @param string $comment
   *
   * @return PublishRequest
   */
  public function setComment($comment) {
    $this->comment = $comment;
    return $this;
  }

  /**
   * @return string
   */
  public function getElapsedTime() {
    return $this->elapsed_time;
  }

  /**
   * @param string $elapsed_time
   *
   * @return PublishRequest
   */
  public function setElapsedTime($elapsed_time) {
    $this->elapsed_time = $elapsed_time;
    return $this;
  }

  /**
   * @return string
   */
  public function getErrorCode() {
    return $this->errorCode;
  }

  /**
   * @param string $errorCode
   *
   * @return PublishRequest
   */
  public function setErrorCode($errorCode) {
    $this->errorCode = $errorCode;
    return $this;
  }

  /**
   * @return string
   */
  public function getQueueMsgId() {
    return $this->queue_msg_id;
  }

  /**
   * @param string $queue_msg_id
   *
   * @return PublishRequest
   */
  public function setQueueMsgId($queue_msg_id) {
    $this->queue_msg_id = $queue_msg_id;
    return $this;
  }

  /**
   * @return string
   */
  public function getRequestedAt() {
    return $this->requested_at;
  }

  /**
   * @param string $requested_at
   *
   * @return PublishRequest
   */
  public function setRequestedAt($requested_at) {
    $this->requested_at = $requested_at;
    return $this;
  }

  /**
   * @return string
   */
  public function getRetries() {
    return $this->retries;
  }

  /**
   * @param string $retries
   *
   * @return PublishRequest
   */
  public function setRetries($retries) {
    $this->retries = $retries;
    return $this;
  }

  /**
   * @return string
   */
  public function getStatus() {
    return $this->status;
  }

  /**
   * @param string $status
   *
   * @return PublishRequest
   */
  public function setStatus($status) {
    $this->status = $status;
    return $this;
  }

}
