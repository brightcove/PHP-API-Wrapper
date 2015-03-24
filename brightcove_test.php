<?php

require_once 'brightcove.php';
require_once 'brightcovetestbase.php';

class BrightcoveTest extends BrightcoveTestBase {
  public function testHasClientData() {
    $this->assertTrue(!!$this->client_id, 'Client ID exists');
    $this->assertTrue(!!$this->client_secret, 'Client secret exists');
    $this->assertTrue(!!$this->account, 'Account exists');
  }

  public function testAuthorization() {
    $client = $this->getClient();
    $this->assertTrue($client->isAuthorized(), 'Client is authorized');
  }
}
