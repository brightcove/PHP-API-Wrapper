<?php

namespace Brightcove\Test;

class Test extends TestBase {
  public function testHasClientData() {
    $this->assertTrue((bool) $this->client_id, 'Client ID exists');
    $this->assertTrue((bool) $this->client_secret, 'Client secret exists');
    $this->assertTrue((bool) $this->account, 'Account exists');
  }

  public function testAuthorization() {
    $client = $this->getClient();
    $this->assertTrue($client->isAuthorized(), 'Client is authorized');
  }
}
