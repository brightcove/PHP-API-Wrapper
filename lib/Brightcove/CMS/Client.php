<?php
namespace Brightcove\CMS;

use Brightcove\API\API;
use Brightcove\Object\Video\Video;
/**
  * This class provides uncached read access to the data via request functions.
 */
class Client extends API {

  protected function cmsRequest($method, $endpoint, $result, $is_array = FALSE, $post = NULL) {
    return $this->client->request($method, 'cms', $this->account, $endpoint, $result, $is_array, $post);
  }

  /**
   * Lists video objects with the given restrictions.
   *
   * @return Video[]
   */
  public function listVideos($search = NULL, $sort = NULL, $limit = NULL, $offset = NULL) {
    $query = '';
    if ($search) {
      $query .= '&q=' . urlencode($search);
    }
    if ($sort) {
      $query .= "&sort={$sort}";
    }
    if ($limit) {
      $query .= "&limit={$limit}";
    }
    if ($offset) {
      $query .= "&offset={$offset}";
    }
    if (strlen($query) > 0) {
      $query = '?' . substr($query, 1);
    }
    return $this->cmsRequest('GET', "/videos{$query}", Video::class, TRUE);
  }

  /**
   * Returns the amount of a searched video's result.
   *
   * @return int|null
   */
  public function countVideos($search = NULL) {
    $query = $search === NULL ? '' : "?q=" . urlencode($search);
    $result = $this->cmsRequest('GET', "/counts/videos{$query}", NULL);
    if ($result && !empty($result['count'])) {
      return $result['count'];
    }
    return NULL;
  }

  /**
   * Gets the images for a single video.
   *
   * @return BrightcoveVideoImages
   */
  public function getVideoImages($video_id) {
    return $this->cmsRequest('GET', "/videos/{$video_id}/images", BrightcoveVideoImages::class);
  }

  /**
   * Gets the sources for a single video.
   *
   * @return BrightcoveVideoSource[]
   */
  public function getVideoSources($video_id) {
    return $this->cmsRequest('GET', "/videos/{$video_id}/sources", BrightcoveVideoSource::class, TRUE);
  }

  public function getVideoFields() {
    return $this->cmsRequest('GET', "/video_fields", BrightcoveCustomFields::class, FALSE);
  }

  /**
   * Gets the data for a single video by issuing a GET request.
   *
   * @return BrightcoveVideo $video
   */
  public function getVideo($video_id) {
    return $this->cmsRequest('GET', "/videos/{$video_id}", BrightcoveVideo::class);
  }

  /**
   * Creates a new video object.
   *
   * @return BrightcoveVideo $video
   */
  public function createVideo(BrightcoveVideo $video) {
    return $this->cmsRequest('POST', '/videos', BrightcoveVideo::class, FALSE, $video);
  }

  /**
   * Updates a video object with an HTTP PATCH request.
   *
   * @return BrightcoveVideo $video
   */
  public function updateVideo(BrightcoveVideo $video) {
    return $this->cmsRequest('PATCH', "/videos/{$video->getId()}", BrightcoveVideo::class, FALSE, $video);
  }

  /**
   * Deletes a video object.
   */
  public function deleteVideo($video_id) {
    return $this->cmsRequest('DELETE', "/videos/{$video_id}", NULL);
  }

  /**
   * @return int
   */
  public function countPlaylists() {
    $result = $this->cmsRequest('GET', "/counts/playlists", NULL);
    if ($result && !empty($result['count'])) {
      return $result['count'];
    }
    return NULL;
  }

  /**
   * @return BrightcovePlaylist[]
   */
  public function listPlaylists($limit = NULL) {
    $limitquery = $limit === NULL ? '' : "?limit={$limit}";
    return $this->cmsRequest('GET', "/playlists{$limitquery}", BrightcovePlaylist::class, TRUE);
  }

  /**
   * @param BrightcovePlaylist $playlist
   * @return BrightcovePlaylist
   */
  public function createPlaylist(BrightcovePlaylist $playlist) {
    return $this->cmsRequest('POST', '/playlists', BrightcovePlaylist::class, FALSE, $playlist);
  }

  /**
   * @param string $playlist_id
   * @return BrightcovePlaylist
   */
  public function getPlaylist($playlist_id) {
    return $this->cmsRequest('GET', "/playlists/{$playlist_id}", BrightcovePlaylist::class);
  }

  /**
   * @param BrightcovePlaylist $playlist
   * @return BrightcovePlaylist
   */
  public function updatePlaylist(BrightcovePlaylist $playlist) {
    return $this->cmsRequest('PATCH', "/playlists/{$playlist->getId()}", BrightcovePlaylist::class, FALSE, $playlist);
  }

  /**
   * @param string $playlist_id
   */
  public function deletePlaylist($playlist_id) {
    $this->cmsRequest('DELETE', "/playlists/{$playlist_id}", NULL);
  }

  /**
   * @param string $playlist_id
   * @return int
   */
  public function getVideoCountInPlaylist($playlist_id) {
    $result = $this->cmsRequest('GET', "/counts/playlists/{$playlist_id}/videos", NULL);
    if ($result && !empty($result['count'])) {
      return $result['count'];
    }
    return NULL;
  }

  /**
   * @param string $playlist_id
   * @return BrightcoveVideo[]
   */
  public function getVideosInPlaylist($playlist_id) {
    return $this->cmsRequest('GET', "/playlists/{$playlist_id}/videos", BrightcoveVideo::class, TRUE);
  }
}