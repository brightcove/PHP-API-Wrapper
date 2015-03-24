<?php

require_once 'brightcove.php';
require_once 'brightcove_cms.php';
require_once 'brightcove_di.php';

class BrightcoveTestBase extends PHPUnit_Framework_TestCase {
  protected $client_id;
  protected $client_secret;
  protected $account;

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
}
