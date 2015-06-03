<?php

namespace Brightcove\Test;

use Brightcove\Object\Playlist;
use Brightcove\Object\Video\Video;
/**
 * Creating test for the Brightcove ManualPlaylist.
 */
class PlaylistTest extends TestBase {
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
      $videos[] = $created_video;
    }
    return $videos;
  }

  /**
   * Creates an empty playlist, then compares it`s name with the returned playlist`s one.
   * @depends testCreateVideos
   * @param Video[] $videos
   * @return array
   */
  public function testCreatePlaylist(array $videos) {
    $playlist = $this->createRandomPlaylistObject();
    $playlist->setType("EXPLICIT");
    $playlist->setName($this->generateRandomString(8));
    $name = $playlist->getName();
    $playlist = $this->cms->createPlaylist($playlist);
    $returnedName = $playlist->getName();

    $this->assertEquals($name, $returnedName);

    return [$playlist, $videos];
  }

  /**
   * Add the video[] to the playlist, then compares with the given playlist result.
   *
   * @depends testCreatePlaylist
   * @param $input[Playlist $playlist, Video videos[]]
   * @return array
   */
  public function testAddVideosToPlaylist(array $input) {
    $playlist = $input[0];
    $videos = $input[1];
    $videoIds = array_map(function($video) {
      return $video->getId();
    }, $videos);
    $playlist->setVideoIds($videoIds);
    $playlist = $this->cms->updatePlaylist($playlist);
    $createdVideoIds = $playlist->getVideoIds();

    $this->assertEquals($videoIds, $createdVideoIds);

    return [$playlist, $videos];
  }

  /**
   * Changing the value of the Playlist`s "Description" attribute.
   *
   * @depends testAddVideosToPlaylist
   * @param $input[Playlist $playlist, Video videos[]]
   * @return array [Playlist, Video[]]
   */
  public function testUpdatePlaylist(array $input) {
    /** @var Playlist $playlist */
    $playlist = $input[0];
    /** @var Video[] $videos */
    $videos = $input[1];
    $playlist->setDescription($this->generateRandomString(8));
    $description = $playlist->getDescription();
    $playlist = $this->cms->updatePlaylist($playlist);
    $createdDescription = $playlist->getDescription();

    $this->assertEquals($description, $createdDescription);

    return [$playlist, $videos];
  }

  /**
   * Deletes every elements from the playlist.
   *
   * @depends testUpdatePlaylist
   * @param $input[Playlist $playlist, Video videos[]]
   * @return array [Playlist, Video[]]
   */
  public function testDeleteFromPlaylist(array $input) {
    /** @var Playlist $playlist */
    $playlist = $input[0];
    /** @var Video[] $videos */
    $videos = $input[1];
    $playlist->setVideoIds([]);
    $videoIds = $playlist->getVideoIds();
    $playlist = $this->cms->updatePlaylist($playlist);
    $createdVideoIds = $playlist->getVideoIds();

    $this->assertEquals($videoIds, $createdVideoIds);

    return [$playlist, $videos];
  }

  /**
   * Deletes the videos from the server.
   *
   * @depends testDeleteFromPlaylist
   * @param $input[Playlist $playlist, Video videos[]]
   * @return Playlist
   */
  public function testDeleteVideos(array $input) {
    /** @var Playlist $playlist */
    $playlist = $input[0];
    /** @var Video[] $videos */
    $videos = $input[1];
    foreach($videos as $video) {
      $this->cms->deleteVideo($video->getId());
    }
    return $playlist;
  }

  /**
   * Deletes the playlist.
   *
   * @depends testDeleteVideos
   * @param Playlist $playlist
   * @return Playlist
   */
  public function testDeletePlaylist(Playlist $playlist) {
    $this->cms->deletePlaylist($playlist->getId());
    return $playlist;
  }

  /**
   * Searching for the deleted playlist in the remained ones,
   * if the result is '0', the delete was successful.
   *
   * @depends testDeletePlaylist
   * @param Playlist $playlist
   */
  public function testCheckDeletePlaylist(Playlist $playlist) {
    $playlist_id = $playlist->getId();
    $this->cms->deletePlaylist($playlist_id);

    $playlistsList = $this->cms->listPlaylists();
    $match = 0;
    foreach ($playlistsList as $plist) {
      if ($plist->getId() === $playlist_id) {
        $match++;
      }
    }
    $this->assertEquals(0, $match, "Playlist has been deleted successfully.");
  }
}