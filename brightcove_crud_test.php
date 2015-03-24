<?php

require_once 'brightcove.php';
require_once 'brightcovetestbase.php';

class BrightcoveVideoCRUDTest extends BrightcoveTestBase {
  /**
   * @var BrightcoveCMS
   */
  protected $cms;
  /**
   * @var BrightcoveDI
   */
  protected $di;

  public function setUp() {
    parent::setUp();
    $client = $this->getClient();
    $this->cms = $this->createCMSObject($client);
    $this->di = $this->createDIObject($client);
  }

  public function testVideoObjectCreation() {
    $video = new BrightcoveVideo();
    $video->name = uniqid('brightcove_api_test_', TRUE);

    $video = $this->cms->createVideo($video);
    $this->assertNotEmpty($video->id, 'Video id is not empty');
    return $video->id;
  }

  /**
   * @depends testVideoObjectCreation
   */
  public function testVideoIngestions($video_id) {
    $request = BrightcoveIngestRequest::createRequest('http://download.blender.org/peach/bigbuckbunny_movies/big_buck_bunny_480p_surround-fix.avi', 'high-bandwidth-devices');
    $ingest = $this->di->createIngest($video_id, $request);
    $this->assertNotEmpty($ingest->id);
    return $ingest->id;
  }
}
