<?php

require_once 'brightcovetestbase.php';

class BrightcoveVideoPlaylistTest extends BrightcoveTestBase {


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
   * Creates an empty playlist, then compares with the given playlist result.
   *
   * @return BrightcovePlaylist[]
   */
  public function testCreatePlaylist() {
    $playlist = $this->createRandomPlaylistObject();
    $playlist->setId('alma');
    $created_playlist = $this->cms->createPlaylist($playlist);
    $this->assertEquals($playlist->getName(), $created_playlist->getName(),'The original and the returned playlists` Ids are the same');

    return $playlist;
  }

  /**
   * Add the random video[] to the playlist, then compares with the given playlist result.
   *
   * @return BrightcovePlaylist
   */
  public function testAddVideosToPlaylist($videos, BrightcovePlaylist $playlist) {

    //Add the videos[] to the playlist
    $playlist->setVideoIds($videos);

    //Checks videos[]`s ids of the original playlist and the returned one.
    $this->assertEquals($playlist->getVideoIds(), $this->cms->getPlaylist('alma')->getVideoIds(),'The playlist is filled with the videos[]');

    return $playlist;
  }

  public function testUpdatePlaylist($videos, BrightcovePlaylist $playlist) {

    //Updates the playlist`s updatedAt property by ISO 8601 date-time string format.
    $playlist->setUpdatedAt('1994-11-05T08:15:30-05:00');

    //Checks videos[]`s ids of the original playlist and the returned one.
    $this->assertEquals($playlist->getUpdatedAt(), $this->cms->getPlaylist('alma')->getUpdatedAt(),'The playlist has been successfully updated');

    return $playlist;
  }

  /**
   * Delete every elelments from the videos[], then compares with the given playlist result.
   *
   * @return BrightcovePlaylist
   */
  public function testDeleteFromPlaylist(BrightcoveVideo $videos, BrightcovePlaylist $playlist) {

    //delete everything from the videos array.
    unset($videos);


    //returns with true if the returned playlist is empty.
    $this->assertEquals(sizeof($this->cms->getPlaylist('alma')->getVideoIds()), 0, 'All elements has been removed from the playlist');

    return $playlist;
  }

}