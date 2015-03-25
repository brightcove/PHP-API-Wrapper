<?php

require_once 'vendor/autoload.php';

class BrightcoveClient {
  protected $access_token;

  public function __construct($access_token) {
    $this->access_token = $access_token;
  }

  public function isAuthorized() {
    return (bool) $this->access_token;
  }

  public static function authorize($client_id, $client_secret) {
    $client = new GuzzleHttp\Client();
    $res = $client->post('https://oauth.brightcove.com/v3/access_token', [
      'body' => 'grant_type=client_credentials',
      'headers' => [
        'Content-Type' => 'application/x-www-form-urlencoded',
      ],
      'auth' => [$client_id, $client_secret],
    ]);

    if ($res->getStatusCode() !== 200) {
      throw new BrightcoveAuthenticationException();
    }

    $json = $res->json();
    if ($json['token_type'] !== 'Bearer') {
      throw new BrightcoveAuthenticationException('Unsupported token type: ' . $json['token_type']);
    }

    return new BrightcoveClient($json['access_token']);
  }

  /**
   * @param string $method
   * @param string $api_type
   * @param string $account
   * @param string $endpoint
   * @param BrightcoveObject|string|null $result
   * @param BrightcoveObject $post
   * @return BrightcoveObject|BrightcoveObject[]|null
   * @throws BrightcoveAPIException
   * @throws JsonMapper_Exception
   */
  public function request($method, $api_type, $account, $endpoint, $result, BrightcoveObject $post = NULL) {
    $client = new GuzzleHttp\Client();
    $body = NULL;
    if ($post) {
      if ($method === 'PATCH') {
        $body = $post->patchJSON();
      } else {
        $body = $post->postJSON();
      }
      $body = json_encode($body);
    }
    $res = $client->{strtolower($method)}("https://{$api_type}.api.brightcove.com/v1/accounts/{$account}{$endpoint}", [
      'headers' => [
        'Authorization' => "Bearer {$this->access_token}",
      ],
      'body' => $body,
    ]);

    $code = $res->getStatusCode();
    if ($code < 200 || $code >= 300) {
      throw new BrightcoveAPIException('Invalid status code: expected 200-299, got ' . $res->getStatusCode());
    }

    $json = $res->json();
    $mapper = new JsonMapper();
    if (is_null($result)) {
      return $json;
    } else if (is_object($result)) {
      $ret = $mapper->map($json, $result);
      $ret->patchJSON();
      return $ret;
    } else {
      $ret = $mapper->mapArray($json, [], $result);
      foreach ($ret as $obj) {
        $obj->patchJSON();
      }
      return $ret;
    }
  }
}

class BrightcoveAPI {
  protected $account;
  protected $client;

  public function __construct(BrightcoveClient $client, $account) {
    $this->client = $client;
    $this->account = $account;
  }
}

interface BrightcoveObject {
  public function postJSON();
  public function patchJSON();
}

class BrightcoveObjectBase implements BrightcoveObject {
  private $changedFields = [];

  protected function fieldChanged($field_name) {
    $this->changedFields[] = $field_name;
  }

  public function postJSON() {
    $data = [];
    foreach ($this as $k => $v) {
      if ($k === 'changedFields' || $v === NULL) {
        continue;
      }
      if ($v instanceof BrightcoveObject) {
        $data[$k] = $v->postJSON();
      } else {
        $data[$k] = $v;
      }
    }
    return $data;
  }

  public function patchJSON() {
    $data = [];
    foreach ($this->changedFields as $field) {
      $val = $this->{$field};
      if ($val === NULL) {
        continue;
      }

      if ($val instanceof BrightcoveObject) {
        $data[$field] = $val->patchJSON();
      } else {
        $data[$field] = $val;
      }
    }

    $this->changedFields = [];

    return $data;
  }
}

class BrightcoveAPIException extends Exception {}
class BrightcoveAuthenticationException extends Exception {}
