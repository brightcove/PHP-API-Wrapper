<?php

require_once 'brightcove.php';

class BrightcoveDI extends BrightcoveAPI {

  protected function diRequest($method, $endpoint, $result, $post = NULL) {
    return $this->client->request($method, 'ingest', $this->account, $endpoint, $result, $post);
  }

  public function createIngest($video_id, BrightcoveIngestRequest $request) {
    return $this->diRequest('POST', "/videos/{$video_id}/ingest-requests", new BrightcoveIngestResponse(), $request);
  }
}

class BrightcoveIngestRequest {
  /**
   * @var BrightcoveIngestRequestMaster
   */
  public $master;
  public $profile;
  public $callbacks;

  public static function createRequest($url, $profile) {
    $request = new self();
    $request->master = new BrightcoveIngestRequestMaster();
    $request->master->url = $url;
    $request->profile = $profile;

    return $request;
  }
}

class BrightcoveIngestRequestMaster {
  public $url;
}

class BrightcoveIngestResponse {
  public $id;
}
