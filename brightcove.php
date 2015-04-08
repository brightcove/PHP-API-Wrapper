<?php

require_once 'vendor/autoload.php';

/**
 * Class BrightcoveClient
 *
 * This class handles the communication with the Brightcove APIs.
 */
class BrightcoveClient {
  /**
   * OAuth2 access token.
   *
   * @var string
   */
  protected $access_token;

  public function __construct($access_token) {
    $this->access_token = $access_token;
  }

  /**
   * Checks if this class has an access token.
   *
   * This usually means that the client is authorized, but not necessarily.
   *
   * @return bool
   */
  public function isAuthorized() {
    return (bool) $this->access_token;
  }

  /**
   * Sends an HTTP request.
   *
   * This method is an abstraction over curl.
   *
   * @param string $method
   *   HTTP method.
   * @param string $url
   *   Full URL.
   * @param array $headers
   *   Headers in curl format: an array of lines, not an associative array.
   * @param null|string $postdata
   *   Postdata to send.
   * @param null|callable $extraconfig
   *   A callback to set extra options on curl. This callback takes one argument,
   *   which is a curl resource and returns nothing.
   * @return array
   *   A two item array. The first item is the status code, the second is the
   *   response body.
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

  /**
   * A factory method to create an authorized BrightcoveClient instance.
   *
   * @param string $client_id
   *   OAuth2 client ID.
   * @param string $client_secret
   *   OAuth2 client secret.
   * @return BrightcoveClient
   *   An authorized client.
   * @throws BrightcoveAuthenticationException
   */
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
   * Sends an authorized request to a Brightcove API endpoint.
   *
   * @param string $method
   *   HTTP method.
   * @param string $api_type
   *   API type, e.g. cms, di etc.
   * @param string $account
   *   Brightcove account ID.
   * @param string $endpoint
   *   API endpoint.
   * @param string|null $result
   *   NULL to return the unmarshalled JSON, or a class name to deserialize into.
   *   This class must implement BrightcoveObject.
   * @param bool $is_array
   *   TRUE if the result is an array of objects. Not used when $result is NULL.
   * @param BrightcoveObject $post
   *   A BrightcoveObject to post.
   * @return BrightcoveObject|BrightcoveObject[]|null
   *   The endpoint result.
   * @throws BrightcoveAPIException
   */
  public function request($method, $api_type, $account, $endpoint, $result, $is_array = FALSE, BrightcoveObject $post = NULL) {
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

    if (is_null($result)) {
      return $json;
    }

    if ($is_array) {
      $ret = [];
      foreach ($json as $item) {
        $ret[] = call_user_func([$result, 'fromJSON'], $item);
      }
      return $ret;
    }

    return call_user_func([$result, 'fromJSON'], $json);
  }
}

/**
 * Class BrightcoveAPI
 *
 * A superclass for the Brightcove API implementations.
 */
abstract class BrightcoveAPI {
  protected $account;
  protected $client;

  public function __construct(BrightcoveClient $client, $account) {
    $this->client = $client;
    $this->account = $account;
  }
}

/**
 * Interface BrightcoveObject
 *
 * All communication between the wrapper and the API endpoints
 * must use classes that implements BrightcoveObject.
 */
interface BrightcoveObject {
  /**
   * Creates an associative array from the class properties and values.
   *
   * @return array
   */
  public function postJSON();

  /**
   * Creates an associative array from the changed class properties and values.
   *
   * This associative array contains the properties that have changed since the
   * last call of patchJSON() or the creation of the class.
   *
   * @return array
   */
  public function patchJSON();

  /**
   * Applies a JSON associative array on this class overwriting the values of the properties.
   *
   * @param array $json
   */
  public function applyJSON(array $json);

  /**
   * Creates an instance of the class, prefilled with values from $json.
   *
   * @param string|array $json
   * @return $this
   */
  public static function fromJSON($json);
}

/**
 * Class BrightcoveObjectBase
 *
 * Base object which implements most methods needed to satisfy BrightcoveObject.
 */
class BrightcoveObjectBase implements BrightcoveObject {
  /**
   * This internal list keeps track of the changed fields.
   *
   * This is necessary bookeeping for patchJSON().
   *
   * @var array
   */
  private $changedFields = [];

  /**
   * Marks a field as changed.
   *
   * All property setters should call this function.
   *
   * @param string $field_name
   */
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

  public function applyJSON(array $json) {}

  /**
   * Helper method for applyJSON().
   *
   * Applies exactly one property on $this.
   *
   * @param array $json
   *   The full JSON array, decoded as an associative array.
   * @param string $name
   *   The name of the property on $this.
   * @param null|string $json_name
   *   The name of the JSON property. If null, then it is the
   *   same as $name.
   * @param null|string $classname
   *   The type of the property. If null, the JSON data will be
   *   copied as it is. If it's a string, it will be instantiated
   *   as a class, which implements BrightcoveObject.
   * @param bool $is_array
   *   If the property is an array. This will be only used
   *   when $classname is not null.
   */
  protected function applyProperty(array $json, $name, $json_name = NULL, $classname = NULL, $is_array = FALSE) {
    if ($json_name === NULL) {
      $json_name = $name;
    }
    if (!isset($json[$json_name])) {
      return;
    }

    if ($classname === NULL) {
      $this->$name = $json[$json_name];
    }
    else {
      if ($is_array) {
        $arr = [];
        foreach ($json[$json_name] as $k => $v) {
          $class = new $classname();
          $class->applyJSON($v);
          $arr[$k] = $class;
        }
        $this->$name = $arr;
      }
      else {
        $class = new $classname();
        $class->applyJSON($json[$json_name]);
        $this->$name = $class;
      }
    }
  }

  public static function fromJSON($json) {
    if (is_string($json)) {
      $json = json_decode($json, TRUE);
    }

    $ret = new static();
    $ret->applyJSON($json);

    return $ret;
  }
}

class BrightcoveAPIException extends Exception {}
class BrightcoveAuthenticationException extends Exception {}
