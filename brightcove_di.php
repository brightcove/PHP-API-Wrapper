<?php

require_once 'brightcove.php';

class BrightcoveDI extends BrightcoveAPI {

  protected function diRequest($method, $endpoint, $result, $post = NULL) {
    return $this->client->request($method, 'ingest', $this->account, $endpoint, $result, $post);
  }

  /**
   * @return BrightcoveIngestResponse
   */
  public function createIngest($video_id, BrightcoveIngestRequest $request) {
    return $this->diRequest('POST', "/videos/{$video_id}/ingest-requests", new BrightcoveIngestResponse(), $request);
  }
}

class BrightcoveIngestRequest extends BrightcoveObjectBase {
  /**
   * @var BrightcoveIngestRequestMaster
   */
  protected $master;
  protected $profile;
  protected $callbacks;

  public static function createRequest($url, $profile) {
    $request = new self();
    $request->setMaster(new BrightcoveIngestRequestMaster());
    $request->getMaster()->setUrl($url);
    $request->setProfile($profile);

    return $request;
  }

  /**
   * @return BrightcoveIngestRequestMaster
   */
  public function getMaster() {
    return $this->master;
  }

  /**
   * @param BrightcoveIngestRequestMaster $master
   * @return $this
   */
  public function setMaster(BrightcoveIngestRequestMaster $master = NULL) {
    $this->master = $master;
    $this->fieldChanged('master');
    return $this;
  }

  /**
   * @return string
   */
  public function getProfile() {
    return $this->profile;
  }

  /**
   * @param string $profile
   * @return $this
   */
  public function setProfile($profile) {
    $this->profile = $profile;
    $this->fieldChanged('profile');
    return $this;
  }

  /**
   * @return array
   */
  public function getCallbacks() {
    return $this->callbacks;
  }

  /**
   * @param array $callbacks
   * @return $this
   */
  public function setCallbacks(array $callbacks) {
    $this->callbacks = $callbacks;
    $this->fieldChanged('callbacks');
    return $this;
  }
}

class BrightcoveIngestRequestMaster extends BrightcoveObjectBase {
  protected $url;

  /**
   * @return string
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * @param string $url
   * @return $this
   */
  public function setUrl($url) {
    $this->url = $url;
    $this->fieldChanged('url');
    return $this;
  }
}

class BrightcoveIngestResponse extends BrightcoveObjectBase {
  protected $id;

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   * @return $this
   */
  public function setId($id) {
    $this->id = $id;
    $this->fieldChanged('id');
    return $this;
  }
}
