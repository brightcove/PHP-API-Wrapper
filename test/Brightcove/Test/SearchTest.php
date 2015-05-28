<?php

use Brightcove\Object\Video\Video;
use Brightcove\Test\TestBase;

class VideoSearchTest extends TestBase {

  /**
   * Creates an array[10] filling it up with random video objects.
   *
   * @return Video[]
   */
  public function testCreateVideos() {
    $videos = [];
    for ($i = 0; $i < 10; $i++) {
      $video = $this->createRandomVideoObject();
      $created_video = $this->cms->createVideo($video);
      $this->assertNotNull($created_video->getId());
      $this->assertEquals($video->getName(), $created_video->getName());
      $videos[] = $created_video;
    }

    return $videos;
  }

  /**
   * @param Video[] $videos
   * @depends testCreateVideos
   * @return Video[]
   */
  public function testSearchVideos($videos) {
    sleep(1);
    $name = $videos[0]->getName();
    $found_videos = [];
    for ($i = 0; $i < 300; $i++) {
      sleep(1);
      $found_videos = $this->cms->listVideos("name:\"{$name}\"");
      if (count($found_videos) > 0) {
        break;
      }
    }
    $this->assertEquals(1, count($found_videos));
    $this->assertEquals($name, $found_videos[0]->getName());
    return $videos;
  }

  /**
   * @param Video[] $videos
   * @depends testSearchVideos
   */
  public function testCleanupVideos($videos) {
    foreach ($videos as $video) {
      $this->cms->deleteVideo($video->getId());
    }
  }
}
