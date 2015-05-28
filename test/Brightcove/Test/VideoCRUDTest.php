<?php
use Brightcove\API\Request\IngestRequest;
use Brightcove\Object\Video\CuePoint;
use Brightcove\Object\Video\Link;
use Brightcove\Object\Video\Sharing;
use Brightcove\Test\TestBase;

/**
 * This class is for create, read, update and delete a random video object.
 * Call the CMS API to create a video object in the Video Cloud system and get its id back.
 */
class VideoCRUDTest extends TestBase {

  public function testVideoObjectCreation() {
    $video = $this->createRandomVideoObject();

    $video = $this->cms->createVideo($video);
    $this->assertNotEmpty($video->getId(), 'Video id is not empty');
    return $video->getId();
  }

  /**
   * We add a request property to the video object.
   * Call the DI API to provide the URL for the video source file and specify the ingest profile to be used.
   *
   * @depends testVideoObjectCreation
   */
  public function testVideoIngestion($video_id) {
    $request = IngestRequest::createRequest('http://download.blender.org/peach/bigbuckbunny_movies/big_buck_bunny_480p_surround-fix.avi', 'high-bandwidth-devices');
    if (!empty($this->callback_addr_remote)) {
      $request->setCallbacks([$this->callback_addr_remote]);
    }
    $ingest = $this->di->createIngest($video_id, $request);
    $this->assertNotEmpty($ingest->getId());
    return $video_id;
  }

  /**
   * Test for the success of the vido object's URL Ingestion.
   * If it fails throws an Error Message.
   *
   * @depends testVideoIngestion
   */
  public function testVideoIngestionCallback($video_id) {
    if (empty($this->callback_host)) {
      $this->markTestSkipped();
    }

    $json = self::waitForHTTPCallback($this->callback_host);
    $this->assertNotEmpty($json, 'Callback result');
    $result = json_decode($json, TRUE);
    $this->assertNotEmpty($result, 'The result is correct JSON');
    $this->assertEquals('SUCCESS', $result['status']);
    return $video_id;
  }

  /**
   * The video object's ID shall not be empty!
   * Compares the created video object's id with the given result's id.
   * They must match.
   *
   * @depends testVideoObjectCreation
   */
  public function testVideoRetrieving($video_id) {
    $video = $this->cms->getVideo($video_id);
    $this->assertNotEmpty($video->getId(), 'Video ID is not empty');
    $this->assertEquals($video_id, $video->getId(), 'Returned video id is the same');
    return $video_id;
  }

  /**
   * Trying to update any possible property of the video object with random strings or given values.
   * They must match with the returned object's same property.
   *
   * @depends testVideoRetrieving
   */
  public function testVideoUpdating($video_id) {
    $video = $this->cms->getVideo($video_id);

    $name = self::generateRandomString();
    $video->setName($name);

    $description = self::generateRandomString();
    $video->setDescription($description);

    $long_description = self::generateRandomString();
    $video->setLongDescription($long_description);

    $cue_point = new CuePoint();

    $cue_name = self::generateRandomString();
    $cue_point->setName($cue_name);

    $type = "AD";
    $cue_point->setType($type);

    $time = 0.0;
    $cue_point->setTime($time);

    $force_stop = false;
    $cue_point->setForceStop(false);

    $video->setCuePoints([$cue_point]);

    $tags = [
      strtolower(self::generateRandomString(5)),
      strtolower(self::generateRandomString(5)),
      strtolower(self::generateRandomString(5)),
      strtolower(self::generateRandomString(5)),
      strtolower(self::generateRandomString(5)),
    ];

    sort($tags);
    $video->setTags($tags);

    $url = self::generateRandomString();
    $text = self::generateRandomString();
    $link = new Link();
    $link->setText($text);
    $link->setUrl($url);

    $video->setLink($link);

    $by_external_acct = true;
    $by_id = $this->account;
    $to_external_acct = true;
    $by_reference = true;

    $sharing = new Sharing();

    $sharing->setByExternalAcct($by_external_acct);
    $sharing->setById($by_id);
    $sharing->setToExternalAcct($to_external_acct);
    $sharing->setByReference($by_reference);

    $video->setSharing($sharing);


    $result = $this->cms->updateVideo($video);

    $this->assertEquals($video_id, $result->getId(), 'Video IDs should be equals');
    $this->assertEquals($name, $result->getName(), 'Names should be updated');
    $this->assertEquals($description, $result->getDescription(), 'Description should be updated');
    $this->assertEquals([$cue_point], $result->getCuePoints(), 'CuePoints should be updated');
    $this->assertEquals($cue_name, $result->getCuePoints()[0]->getName(), 'Cue Names should be updated');
    $this->assertEquals($time, $result->getCuePoints()[0]->getTime(), 'Times should be updated');
    $this->assertEquals($force_stop, $result->getCuePoints()[0]->getForceStop(), 'Force should be updated');
    $this->assertEquals($url, $result->getLink()->getUrl(), 'The link object`s URL field should be updated');
    $this->assertEquals($text, $result->getLink()->getText(), 'The link object`s Text field should be updated');
    $this->assertEquals($by_external_acct, $result->getSharing()->getByExternalAcct(), 'The sharing object`s by_external field should be updated');
    $this->assertEquals($by_id, $result->getSharing()->getById(), 'The sharing object`s by_id field should be updated');
    $this->assertEquals($to_external_acct, $result->getSharing()->getToExternalAcct(), 'The sharing object`s to_external_acct field should be updated');
    $this->assertEquals($by_reference, $result->getSharing()->getByReference(), 'The sharing object`s by_reference field should be updated');


    $new_tags = $result->getTags();
    sort($new_tags);
    $this->assertEquals($tags, $new_tags, 'Tags should be updated');

    return $video_id;
  }

  /**
   * You can delete a video object in your account.
   *
   * @depends testVideoUpdating
   */
  public function testVideoDeleting($video_id) {
    $this->cms->deleteVideo($video_id);
  }
}
