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

  /**
   * @param string $method
   * @param string $url
   * @param array $headers
   * @param null|array|string $postdata
   * @param null|callable $extraconfig
   * @return array
   */
  public static function HTTPRequest($method, $url, $headers = [], $postdata = NULL, $extraconfig = NULL) {
    $ch = curl_init();

    if ($postdata !== NULL) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
      $headers[] = 'Content-Length: ' . strlen($postdata);
    }

    curl_setopt_array($ch, [
      CURLOPT_AUTOREFERER => TRUE,
      CURLOPT_FOLLOWLOCATION => TRUE,
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_SAFE_UPLOAD => TRUE,
      CURLOPT_MAXREDIRS => 5,
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_URL => $url,
      CURLOPT_HTTPHEADER => $headers,
    ]);

    if ($extraconfig !== NULL) {
      $extraconfig($ch);
    }

    $result = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    return [$code, $result];
  }

  public static function authorize($client_id, $client_secret) {
    list($code, $response) = self::HTTPRequest('POST', 'https://oauth.brightcove.com/v3/access_token',
      ['Content-Type: application/x-www-form-urlencoded'],
      'grant_type=client_credentials',
      function ($ch) use ($client_id, $client_secret) {
        curl_setopt($ch, CURLOPT_USERPWD, "{$client_id}:{$client_secret}");
      });

    if ($code !== 200) {
      throw new BrightcoveAuthenticationException();
    }

    $json = json_decode($response, TRUE);
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
    $body = NULL;
    if ($post) {
      if ($method === 'PATCH') {
        $body = $post->patchJSON();
      } else {
        $body = $post->postJSON();
      }
      $body = json_encode($body);
    }
    list($code, $res) = self::HTTPRequest($method, "https://{$api_type}.api.brightcove.com/v1/accounts/{$account}{$endpoint}",
      ["Authorization: Bearer {$this->access_token}"], $body);
    if ($code < 200 || $code >= 300) {
      throw new BrightcoveAPIException("Invalid status code: expected 200-299, got {$code}.\n\n{$res}");
    }

    $json = json_decode($res, TRUE);
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
    foreach ($this as $field => $val) {
      if ($field === 'changedFields' || $val === NULL) {
        continue;
      }
      if ($val instanceof BrightcoveObject) {
        $data[$field] = $val->postJSON();
      }
      else if (is_array($val)) {
        $data[$field] = [];
        foreach ($val as $k => $v) {
          if ($v instanceof BrightcoveObject) {
            $data[$field][$k] = $v->postJSON();
          }
          else {
            $data[$field][$k] = $v;
          }
        }
      } else {
        $data[$field] = $val;
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
      } else if (is_array($val)) {
        $data[$field] = [];
        foreach ($val as $k => $v) {
          if ($v instanceof BrightcoveObject) {
            $data[$field][$k] = $v->patchJSON();
          } else {
            $data[$field][$k] = $v;
          }
        }
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
