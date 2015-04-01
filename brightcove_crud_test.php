<?php

require_once 'brightcovetestbase.php';

class BrightcoveVideoCRUDTest extends BrightcoveTestBase {

  public function testVideoObjectCreation() {
    $video = $this->createRandomVideoObject();

    $video = $this->cms->createVideo($video);
    $this->assertNotEmpty($video->getId(), 'Video id is not empty');
    return $video->getId();
  }

  /**
   * @depends testVideoObjectCreation
   */
  public function testVideoIngestions($video_id) {
    $request = BrightcoveIngestRequest::createRequest('http://download.blender.org/peach/bigbuckbunny_movies/big_buck_bunny_480p_surround-fix.avi', 'high-bandwidth-devices');
    $ingest = $this->di->createIngest($video_id, $request);
    $this->assertNotEmpty($ingest->getId());
    return $ingest->getId();
  }

  /**
   * @depends testVideoObjectCreation
   */
  public function testVideoRetrieving($video_id) {
    $video = $this->cms->getVideo($video_id);
    $this->assertNotEmpty($video->getId(), 'Video ID is not empty');
    $this->assertEquals($video_id, $video->getId(), 'Returned video id is the same');
    return $video_id;
  }

  /**
   * @depends testVideoRetrieving
   */
  public function testVideoUpdating($video_id) {
    $video = $this->cms->getVideo($video_id);
    $description = self::generateRandomString();
    $video->setDescription($description);
    $name = self::generateRandomString();
    $video->setName($name);
    $cue_point = new BrightcoveVideoCuePoint();
    $cue_name = self::generateRandomString();
    $cue_point->setName($cue_name);
    $type = "AD";
    $cue_point->setType($type);
    $time = 1.01;
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
    sleep(1);
    $result = $this->cms->updateVideo($video);
    $this->assertEquals($video_id, $result->getId(), 'Video IDs should be equals');
    $this->assertEquals($description, $result->getDescription(), 'Description should be updated');
    $this->assertEquals($name, $result->getName(), 'Names should be updated');
    $this->assertEquals(1, count($result->getCuePoints()), 'Cue points == 1');
    $this->assertEquals([$cue_point], $result->getCuePoints(), 'CuePoints should be updated');
    $this->assertEquals($cue_name, $result->getCuePoints()[0]->getName(), 'Cue Names should be updated');
    $this->assertEquals($time, $result->getCuePoints()[0]->getTime(), 'Tmes should be updated');
    $this->assertEquals($force_stop, $result->getCuePoints()[0]->getForceStop(), 'Force should be updated');



    $new_tags = $result->getTags();
    sort($new_tags);
    $this->assertEquals($tags, $new_tags, 'Tags should be updated');
    return $video_id;
  }

  /**
   * @depends testVideoUpdating
   */
  public function testVideoDeleting($video_id) {
    $this->cms->deleteVideo($video_id);
  }
}
