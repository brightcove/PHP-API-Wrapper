<?php

namespace Brightcove\Test;

use Brightcove\Object\Playlist;
use Brightcove\Object\Video\Video;
/**
 * Creating test for the Brightcove SmartPlaylist.
 */
class SmartPlaylistTest extends TestBase {

  /**
   * Creates an array[10] filling it up with random video objects
   * and sets the Tag field with a random string.
   *
   * @return Video[]
   */
  public function testCreateVideos() {
    $videos = [];
    $videoTag[0] = $this->generateRandomString(8);
    for ($i = 0; $i < 10; $i++) {
      $video = $this->createRandomVideoObject();
      $video->setTags($videoTag);
      $created_video = $this->cms->createVideo($video);
      $this->assertNotNull($created_video->getId());
      $videos[] = $created_video;
    }
    return $videos;
  }

  /**
   * Creates an empty SmartPlaylist, then compares it`s name with the returned playlist`s one.
   * @depends testCreateVideos
   * @param Video[] $videos
   * @return array
   */
  public function testCreatePlaylist($videos) {
    $playlist = $this->createRandomPlaylistObject();
    $playlist->setType("ALPHABETICAL");
    $playlist->setName($this->generateRandomString(8));
    $name = $playlist->getName();
    $playlist = $this->cms->createPlaylist($playlist);
    $returnedName = $playlist->getName();

    $this->assertEquals($name, $returnedName);

    return [$playlist, $videos];
  }

  /**
   * Set the SmartPlayist`s Search field
   * to the same value as the videos` Tag,
   * then compares with the given one.
   *
   * @depends testCreatePlaylist
   * @param $input[Playlist $playlist, Video[] $videos]
   * @return array
   */
  public function testSetSearchToPlaylist(array $input) {
    $playlist = $input[0];
    $videos = $input[1];
    $videoTag = $videos[0]->getTags();
    $playlist->setSearch("+tags:"."\"".$videoTag[0]."\"");
    $search = $playlist->getSearch();
    $playlist = $this->cms->updatePlaylist($playlist);
    $returnedSearch = $playlist->getSearch();

    $this->assertEquals($search, $returnedSearch);

    return [$playlist, $videos];
  }

  /**
   * Deletes the videos from the server.
   *
   * @depends testSetSearchToPlaylist
   * @param $input[Playlist $playlist, Video[] $videos]
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
   * Set the Description field of the SmartPlaylist, then compares with the given one.
   *
   * @depends testDeleteVideos
   * @param Playlist $playlist
   * @return Playlist
   */
  public function testSetDescriptionToPlaylist(Playlist $playlist) {
    $playlist->setDescription($this->generateRandomString(18));
    $description = $playlist->getDescription();
    $playlist = $this->cms->updatePlaylist($playlist);
    $returnedDescription = $playlist->getDescription();

    $this->assertEquals($description, $returnedDescription);

    return $playlist;
  }

  /**
   * Deletes the SmartPlaylist.
   *
   * @depends testSetDescriptionToPlaylist
   * @param Playlist $playlist
   * @return Playlist
   */
  public function testDeletePlaylist(Playlist $playlist) {
    $this->cms->deletePlaylist($playlist->getId());
    return $playlist;
  }

  /**
   * Searching for the deleted SmartPlaylist in the remained ones,
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