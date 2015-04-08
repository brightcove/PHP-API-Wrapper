<?php

require_once 'brightcove.php';
require_once 'brightcove_cms.php';
require_once 'brightcove_di.php';

/**
 * Class BrightcoveTestBase
 *
 * Base class for all test for the Brightcove API wrapper.
 */
class BrightcoveTestBase extends PHPUnit_Framework_TestCase {

  /**
   * OAuth2 client id.
   *
   * @var string
   */
  protected $client_id;

  /**
   * OAuth2 client secret.
   *
   * @var string
   */
  protected $client_secret;

  /**
   * Brightcove account ID.
   *
   * @var string
   */
  protected $account;

  /**
   * A local address on which a PHP webserver can be started.
   *
   * @see waitForHTTPCallback()
   * @see startServer()
   *
   * @var string
   */
  protected $callback_host;

  /**
   * A remote address which could be used for HTTP callbacks.
   *
   * @see waitForHTTPCallback()
   *
   * @var string
   */
  protected $callback_addr_remote;

  /**
   * A Brightcove client to be used with the endpoint wrapper classes.
   *
   * @var BrightcoveClient
   */
  protected $client;

  /**
   * A wrapper instance on the CMS API.
   *
   * @var BrightcoveCMS
   */
  protected $cms;

  /**
   * A wrapper instance on the DI API.
   *
   * @var BrightcoveDI
   */
  protected $di;

  /**
   * Creates a new authorized client instance.
   *
   * @return BrightcoveClient
   * @throws BrightcoveAuthenticationException
   */
  protected function getClient() {
    return BrightcoveClient::authorize($this->client_id, $this->client_secret);
  }

  /**
   * Sets up the test class.
   *
   * Currently it reads the command line arguments and sets up the client and the wrapper objects.
   */
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
          case 'callback-host':
            $this->callback_host = $value;
            break;
          case 'callback-addr-remote':
            $this->callback_addr_remote = $value;
            break;
        }
      }
    }

    $this->client = $this->getClient();
    $this->cms = $this->createCMSObject($this->client);
    $this->di = $this->createDIObject($this->client);
  }

  /**
   * Creates a new CMS object instance.
   *
   * @param BrightcoveClient $client
   *   The $client instance to use. If NULL, then the client of this class will be used.
   * @return BrightcoveCMS
   */
  protected function createCMSObject(BrightcoveClient $client = NULL) {
    if ($client === NULL) {
      $client = $this->getClient();
    }
    return new BrightcoveCMS($client, $this->account);
  }

  /**
   * Creates a new DI object instance.
   *
   * @param BrightcoveClient $client
   *   The $client instance to use. If NULL, then the client of this class will be used.
   * @return BrightcoveDI
   */
  protected function createDIObject(BrightcoveClient $client = NULL) {
    if ($client === NULL) {
      $client = $this->getClient();
    }
    return new BrightcoveDI($client, $this->account);
  }

  /**
   * Creates an empty video object with a random name.
   *
   * @return BrightcoveVideo
   */
  protected function createRandomVideoObject() {
    $video = new BrightcoveVideo();
    $video->setName(uniqid('brightcove_api_test_', TRUE));
    return $video;
  }

  /**
   * Generates a random string.
   *
   * This is random enough to be used for video object properties, but not secure.
   *
   * @param int $length
   * @return string
   */
  public static function generateRandomString($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  /**
   * Creates a background server and waits for the callback response.
   *
   * @param string $host
   *   Host to listen on.
   * @param int $timeout
   *   Timeout in seconds.
   * @return string
   *   The response body.
   */
  public static function waitForHTTPCallback($host, $timeout = 300) {
    self::startServer($host, 'server.lock');
    while (!self::checkFile() && $timeout > 0) {
      sleep(1);
      $timeout--;
    }
    $answer = file_get_contents('server_out.txt');
    self::stopServer('server.lock');
    return $answer;
  }

  /**
   * Checks if the response file exists and has content.
   *
   * @return bool
   */
  private static function checkFile() {
    clearstatcache();
    return filesize('server_out.txt') > 0;
  }

  /**
   * Starts a server in the background.
   *
   * @param string $host
   *   Host to listen on.
   * @param string $pidfile
   *   Path for the pidfile which will be created when the server starts.
   */
  private static function startServer($host, $pidfile) {
    $cmd = "php -S {$host} router.php";
    $outputfile = 'server_out.txt';
    shell_exec(sprintf("%s > %s 2>&1 & echo $! >> %s", $cmd, $outputfile, $pidfile));
    sleep(1);
  }

  /**
   * Stops the background server.
   *
   * @param string $pidfile
   *   Path for the pidfile. The pidfile contains process IDs, which will be terminated.
   */
  private static function stopServer($pidfile) {
    if (file_exists($pidfile)) {
      $pids = file($pidfile);
      foreach ($pids as $pid) {
        shell_exec('kill -9 ' . $pid);
      }
      unlink($pidfile);
    }
    unlink('server_out.txt');
  }
}
