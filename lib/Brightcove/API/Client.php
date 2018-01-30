<?php

namespace Brightcove\API;


use Brightcove\API\Exception\AuthenticationException;
use Brightcove\API\Exception\APIException;
use Brightcove\Constants;
use Brightcove\Object\ObjectInterface;

/**
 * This Class handles the communication with the Brightcove APIs.
 *
 * @internal
 */
class Client {

  /**
   * A filename for a verbose request log.
   *
   * @var string
   */
  public static $debugRequests = NULL;

  /**
   * Retries the request if Brightcove rate limits the client.
   *
   * @var bool
   */
  public static $retry = FALSE;

  /**
   * CURLOPT_HTTPPROXYTUNNEL
   *
   * @var bool
   */
  public static $httpProxyTunnel = NULL;

  /**
   * CURLOPT_PROXYAUTH
   *
   * @var int
   */
  public static $proxyAuth = NULL;

  /**
   * CURLOPT_PROXYPORT
   *
   * @var int
   */
  public static $proxyPort = NULL;

  /**
   * CURLOPT_PROXYTYPE
   *
   * @var int
   */
  public static $proxyType = NULL;

  /**
   * CURLOPT_PROXY
   *
   * @var string
   */
  public static $proxy = NULL;

  /**
   * CURLOPT_PROXYUSERPWD
   *
   * @var string
   */
  public static $proxyUserPassword = NULL;

  /**
   * Consumer name and version.
   *
   * Setting this to not NULL will enable overriding the user agent.
   *
   * @var string|NULL
   */
  public static $consumer = NULL;

  /**
   * OAuth2 access token.
   *
   * @var string
   */
  protected $access_token;

  /**
   * Token expiration
   *
   * @var int
   */
  protected $expires_in;

  /**
   * Client constructor.
   *
   * @param $access_token
   * @param int $expires_in
   *
   * @internal
   */
  public function __construct($access_token, $expires_in = 0) {
    $this->access_token = $access_token;
    $this->expires_in = $expires_in;
  }

  /**
   * Returns the OAuth2 access token.
   *
   * @return string
   *
   * @internal
   */
  public function getAccessToken() {
    return $this->access_token;
  }

  /**
   * Returns the access token expiration.
   *
   * This value might not be correct. The object stores the response
   * from Brightcove, but it does not adjust it as the time passes.
   *
   * @return int
   *
   * @internal
   */
  public function getExpiresIn() {
    return $this->expires_in;
  }

  /**
   * Checks if this class has an access token.
   *
   * This usually means that the client is authorized, but not necessarily.
   *
   * @return bool
   *
   * @internal
   */
  public function isAuthorized() {
    return (bool) $this->getAccessToken();
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
   *
   * @internal
   */
  public static function HTTPRequest($method, $url, array $headers = [], $postdata = NULL, callable $extraconfig = NULL) {
    $ch = curl_init();

    if ($postdata !== NULL) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
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
      CURLINFO_HEADER_OUT => (bool) self::$debugRequests,
    ]);

    self::configureProxy($ch);

    if (static::$consumer) {
      curl_setopt($ch, CURLOPT_USERAGENT, static::getUserAgent());
    }

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
          'request' => curl_getinfo($ch, CURLINFO_HEADER_OUT),
          'request_body' => $postdata,
          'response' => [$code, $result],
          'response_headers' => $res_headers,
        ], TRUE) . "\n\n", FILE_APPEND);
    }

    curl_close($ch);

    return [$code, $result];
  }

  /**
   * Configures the proxy settings on a curl resource.
   *
   * @param resource $ch Curl resource
   *
   * @internal
   */
  protected static function configureProxy($ch) {
    if (self::$httpProxyTunnel) {
      curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, self::$httpProxyTunnel);
    }
    if (self::$proxyAuth) {
      curl_setopt($ch, CURLOPT_PROXYAUTH, self::$proxyAuth);
    }
    if (self::$proxyPort) {
      curl_setopt($ch, CURLOPT_PROXYPORT, self::$proxyPort);
    }
    if (self::$proxyType) {
      curl_setopt($ch, CURLOPT_PROXYTYPE, self::$proxyType);
    }
    if (self::$proxy) {
      curl_setopt($ch, CURLOPT_PROXY, self::$proxy);
    }
    if (self::$proxyUserPassword) {
      curl_setopt($ch, CURLOPT_PROXYUSERPWD, self::$proxyUserPassword);
    }
  }

  /**
   * Constructs the user agent string.
   *
   * @return string
   *
   * @internal
   */
  protected static function getUserAgent() {
    $api_wrapper_version = Constants::VERSION;
    $consumer = static::$consumer;
    $host = $_SERVER['HTTP_HOST'] ?: gethostname();
    $software = $_SERVER['SERVER_SOFTWARE'];
    $curl_version = curl_version()['version'];
    return "PHP-API-Wrapper/{$api_wrapper_version} ({$host}; {$software} curl/{$curl_version}) {$consumer}";
  }

  /**
   * A factory method to create an authorized Client instance.
   *
   * @param string $client_id
   *   OAuth2 client ID.
   * @param string $client_secret
   *   OAuth2 client secret.
   * @return Client
   *   An authorized client.
   * @throws AuthenticationException
   *
   * @internal
   */
  public static function authorize($client_id, $client_secret) {
    list($code, $response) = self::HTTPRequest('POST', 'https://oauth.brightcove.com/v3/access_token',
      ['Content-Type: application/x-www-form-urlencoded'],
      'grant_type=client_credentials',
      function ($ch) use ($client_id, $client_secret) {
        curl_setopt($ch, CURLOPT_USERPWD, "{$client_id}:{$client_secret}");
      });

    if ($code !== 200) {
      throw new AuthenticationException();
    }

    $json = json_decode($response, TRUE);
    if ($json['token_type'] !== 'Bearer') {
      throw new AuthenticationException('Unsupported token type: ' . $json['token_type']);
    }

    return new Client($json['access_token'], $json['expires_in']);
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
   *   This class must implement ObjectInterface.
   * @param bool $is_array
   *   TRUE if the result is an array of objects. Not used when $result is NULL.
   * @param ObjectInterface $post
   *   A ObjectInterface to post.
   * @return ObjectInterface|ObjectInterface[]|null
   *   The endpoint result.
   * @throws APIException
   *
   * @internal
   */
  public function request($method, $api_version, $api_type, $account, $endpoint, $result, $is_array = FALSE, ObjectInterface $post = NULL) {
    $body = NULL;
    if ($post) {
      if ($method === 'PATCH') {
        $body = $post->patchJSON();
      } else {
        $body = $post->postJSON();
      }
      $body = json_encode($body);
    }

    $total_requests = 0;
    do {
      list($code, $res) = self::HTTPRequest($method,
        "https://{$api_type}.api.brightcove.com/v{$api_version}/accounts/{$account}{$endpoint}",
        ["Authorization: Bearer {$this->access_token}"], $body);
    }
    // Automatically request again, if we hit the rate limit. In between though
    // wait for 2 seconds, just to be 100% sure.
    // Read on https://docs.brightcove.com/en/video-cloud/cms-api/getting-started/overview-cms.html
    // for more information about the rate limiting.
    // We also provide a check to not run into an infinite loop.
    while (static::$retry && $total_requests++ < 10 && $code == 429 && sleep(2));

    if ($code < 200 || $code >= 300) {
      throw new APIException("Invalid status code: expected 200-299, got {$code}.\n\n{$res}", $code, NULL, $res);
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
