<?php

namespace Brightcove\API;

/**
 * This Class handles the communication with the Brightcove APIs.
 */
class Client {
  public static $debugRequests = FALSE;

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
  public static function HTTPRequest($method, $url, array $headers = [], $postdata = NULL, callable $extraconfig = NULL) {
    $ch = curl_init();

    if ($postdata !== NULL) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
      $headers[] = 'Content-Length: ' . strlen($postdata);
      $headers[] = 'Content-Type: application/json';
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
      CURLOPT_HEADER => TRUE,
    ]);

    if ($extraconfig !== NULL) {
      $extraconfig($ch);
    }

    $rawresult = curl_exec($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $res_headers = substr($rawresult, 0, $header_size);
    $result = substr($rawresult, $header_size);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (self::$debugRequests) {
      file_put_contents(self::$debugRequests, var_export([
          'request' => "{$method} {$url}",
          'headers' => $headers,
          'response' => [$code, $result],
          'response_headers' => $res_headers,
        ], TRUE) . "\n\n", FILE_APPEND);
    }

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
      throw new BrightcoveAPIException("Invalid status code: expected 200-299, got {$code}.\n\n{$res}", $code, NULL, $res);
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