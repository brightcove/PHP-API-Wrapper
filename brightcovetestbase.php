<?php

require_once 'brightcove.php';
require_once 'brightcove_cms.php';
require_once 'brightcove_di.php';

class BrightcoveTestBase extends PHPUnit_Framework_TestCase {
  protected $client_id;
  protected $client_secret;
  protected $account;

  /**
   * @var BrightcoveClient
   */
  protected $client;

  /**
   * @var BrightcoveCMS
   */
  protected $cms;

  /**
   * @var BrightcoveDI
   */
  protected $di;

  protected function getClient() {
    return BrightcoveClient::authorize($this->client_id, $this->client_secret);
  }

  public function setUp() {
    foreach ($_SERVER['argv'] as $arg) {
      if (substr($arg, 0, 2) === '--') {
        $arg = substr($arg, 2);
        list($key, $value) = explode('=', $arg, 2);
        switch ($key) {
          case 'client-id':
            $this->client_id = $value;
            break;
          case 'client-secret':
            $this->client_secret = $value;
            break;
          case 'account':
            $this->account = $value;
            break;
        }
      }
    }

    $this->client = $this->getClient();
    $this->cms = $this->createCMSObject($this->client);
    $this->di = $this->createDIObject($this->client);
  }

  protected function createCMSObject(BrightcoveClient $client = NULL) {
    if ($client === NULL) {
      $client = $this->getClient();
    }
    return new BrightcoveCMS($client, $this->account);
  }

  protected function createDIObject(BrightcoveClient $client = NULL) {
    if ($client === NULL) {
      $client = $this->getClient();
    }
    return new BrightcoveDI($client, $this->account);
  }

  protected function createRandomVideoObject() {
    $video = new BrightcoveVideo();
    $video->setName(uniqid('brightcove_api_test_', TRUE));
    return $video;
  }

  public static function generateRandomString($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
}
