<?php

namespace Brightcove\Test;

use Brightcove\API\Client;
use Brightcove\API\CMS;
use Brightcove\API\DI;
use Brightcove\API\Exception\AuthenticationException;
use Brightcove\API\PM;
use Brightcove\Object\Playlist;
use Brightcove\Object\Video\Video;

/**
 * Base class for all test for the Brightcove API wrapper.
 */
class TestBase extends \PHPUnit_Framework_TestCase {

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
   * @var Client
   */
  protected $client;

  /**
   * A wrapper instance on the CMS API.
   *
   * @var CMS
   */
  protected $cms;

  /**
   * A wrapper instance on the DI API.
   *
   * @var DI
   */
  protected $di;

  /**
   * A wrapper instance on the PM API.
   *
   * @var PM
   */
  protected $pm;

  /**
   * Creates a new authorized client instance.
   *
   * @return Client
   * @throws AuthenticationException
   */
  protected function getClient() {
    return Client::authorize($this->client_id, $this->client_secret);
  }

  /**
   * Sets up the test class.
   *
   * Currently it reads the command line arguments and sets up the client and the wrapper objects.
   */
  public function setUp() {
    $json = file_get_contents("config.json");
    if ($json) {
      $config = json_decode($json, TRUE);
      if (is_array($config)) {
        foreach ($config as $k => $v) {
          $this->{$k} = $v;
        }
      }
    }

    $this->client = $this->getClient();
    $this->cms = $this->createCMSObject($this->client);
    $this->di = $this->createDIObject($this->client);
    $this->pm = $this->createPMObject($this->client);
  }

  /**
   * Creates a new CMS object instance.
   *
   * @param Client $client
   *   The $client instance to use. If NULL, then the client of this class will be used.
   * @return CMS
   */
  protected function createCMSObject(Client $client = NULL) {
    if ($client === NULL) {
      $client = $this->getClient();
    }
    return new CMS($client, $this->account);
  }

  /**
   * Creates a new DI object instance.
   *
   * @param Client $client
   *   The $client instance to use. If NULL, then the client of this class will be used.
   * @return DI
   */
  protected function createDIObject(Client $client = NULL) {
    if ($client === NULL) {
      $client = $this->getClient();
    }
    return new DI($client, $this->account);
  }

  /**
   * Creates a new PM object instance.
   *
   * @param Client $client
   *   The $client instance to use. If NULL, then the client of this class will be used.
   * @return PM
   */
  protected function createPMObject(Client $client = NULL) {
    if ($client === NULL) {
      $client = $this->getClient();
    }
    return new PM($client, $this->account);
  }

  /**
   * Creates an empty video object with a random name.
   *
   * @return Video
   */
  protected function createRandomVideoObject() {
    $video = new Video();
    $video->setName(uniqid('brightcove_api_test_', TRUE));
    return $video;
  }

  /**
   * Creates an empty playlist object with a random name.
   *
   * @return Playlist
   */
  protected function createRandomPlaylistObject() {
    $playlist = new Playlist();
    $playlist->setName(uniqid('brightcove_api_test_', TRUE));
    return $playlist;
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
