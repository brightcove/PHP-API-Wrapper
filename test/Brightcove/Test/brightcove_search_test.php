<?php

require_once 'brightcovetestbase.php';

class BrightcoveVideoSearchTest extends BrightcoveTestBase {

  /**
   * Creates an array[10] filling it up with random video objects.
   *
   * @return BrightcoveVideo[]
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
   * @param BrightcoveVideo[] $videos
   * @depends testCreateVideos
   * @return BrightcoveVideo[]
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
   * @param BrightcoveVideo[] $videos
   * @depends testSearchVideos
   */
  public function testCleanupVideos($videos) {
    foreach ($videos as $video) {
      $this->cms->deleteVideo($video->getId());
    }
  }
}
