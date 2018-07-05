<?php
namespace Brightcove\API;

use Brightcove\API\Request\SubscriptionRequest;
use Brightcove\Object\Subscription;
use Brightcove\Object\Video\Video;
use Brightcove\Object\Video\Source;
use Brightcove\Object\Video\Images;
use Brightcove\Object\Video\Poster;
use Brightcove\Object\Video\Thumbnail;
use Brightcove\Object\Playlist;
use Brightcove\Object\CustomFields;

/**
  * This class provides uncached read access to the data via request functions.
 *
 * @api
 */
class CMS extends API {

  protected function cmsRequest($method, $endpoint, $result, $is_array = FALSE, $post = NULL) {
    return $this->client->request($method, '1','cms', $this->account, $endpoint, $result, $is_array, $post);
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
   * @return Images
   */
  public function getVideoImages($video_id) {
    return $this->cmsRequest('GET', "/videos/{$video_id}/images", Images::class);
  }

  /**
   * Gets the sources for a single video.
   *
   * @return Source[]
   */
  public function getVideoSources($video_id) {
    return $this->cmsRequest('GET', "/videos/{$video_id}/sources", Source::class, TRUE);
  }

  public function getVideoFields() {
    return $this->cmsRequest('GET', "/video_fields", CustomFields::class, FALSE);
  }

  /**
   * Gets the data for a single video by issuing a GET request.
   *
   * @return Video $video
   */
  public function getVideo($video_id) {
    return $this->cmsRequest('GET', "/videos/{$video_id}", Video::class);
  }

  /**
   * Creates a new video object.
   *
   * @return Video $video
   */
  public function createVideo(Video $video) {
    return $this->cmsRequest('POST', '/videos', Video::class, FALSE, $video);
  }

  /**
   * Updates a video object with an HTTP PATCH request.
   *
   * @return Video $video
   */
  public function updateVideo(Video $video) {
    $video->fieldUnchanged('account_id', 'id');
    return $this->cmsRequest('PATCH', "/videos/{$video->getId()}", Video::class, FALSE, $video);
  }

  /**
   * Deletes a video object.
   */
  public function deleteVideo($video_id) {
    return $this->cmsRequest('DELETE', "/videos/{$video_id}", NULL);
  }

  /**
   * Gets the data for a single poster by issuing a GET request.
   *
   * @return Video $video
   */
  public function getPoster($video_id) {
    return $this->cmsRequest('GET', "/videos/{$video_id}/assets/poster", Poster::class);
  }

  /**
   * Creates a new poster object.
   *
   * @return Poster $poster
   */
  public function createPoster($video_id, Poster $poster) {
    return $this->cmsRequest('POST', "/videos/{$video_id}/assets/poster", Poster::class, FALSE, $poster);
  }

  /**
   * Updates a poster object with an HTTP PATCH request.
   *
   * @return Poster $poster
   */
  public function updatePoster($video_id, Poster $poster) {
    $poster->fieldUnchanged('id');
    return $this->cmsRequest('PATCH', "/videos/{$video_id}/assets/poster/{$poster->getId()}", Poster::class, FALSE, $poster);
  }

  /**
   * Deletes a poster object.
   */
  public function deletePoster($video_id, $poster_id) {
    return $this->cmsRequest('DELETE', "/videos/{$video_id}/assets/poster/{$poster_id}", NULL);
  }

  /**
   * Gets the data for a single thumbnail by issuing a GET request.
   *
   * @return Video $video
   */
  public function getThumbnail($video_id) {
    return $this->cmsRequest('GET', "/videos/{$video_id}/assets/thumbnail", Thumbnail::class);
  }

  /**
   * Creates a new thumbnail object.
   *
   * @return Poster $thumbnail
   */
  public function createThumbnail($video_id, Thumbnail $thumbnail) {
    return $this->cmsRequest('POST', "/videos/{$video_id}/assets/thumbnail", Thumbnail::class, FALSE, $thumbnail);
  }

  /**
   * Updates a thumbnail object with an HTTP PATCH request.
   *
   * @return Poster $thumbnail
   */
  public function updateThumbnail($video_id, Thumbnail $thumbnail) {
    $poster->fieldUnchanged('id');
    return $this->cmsRequest('PATCH', "/videos/{$video_id}/assets/thumbnail/{$thumbnail->getId()}", Thumbnail::class, FALSE, $thumbnail);
  }

  /**
   * Deletes a thumbnail object.
   */
  public function deleteThumbnail($video_id, $thumbnail_id) {
    return $this->cmsRequest('DELETE', "/videos/{$video_id}/assets/thumbnail/{$thumbnail_id}", NULL);
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
   * @return Playlist[]
   */
  public function listPlaylists($sort = NULL, $limit = NULL, $offset = NULL) {
    $query = '';
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
    return $this->cmsRequest('GET', "/playlists{$query}", Playlist::class, TRUE);
  }

  /**
   * @param Playlist $playlist
   * @return Playlist
   */
  public function createPlaylist(Playlist $playlist) {
    return $this->cmsRequest('POST', '/playlists', Playlist::class, FALSE, $playlist);
  }

  /**
   * @param string $playlist_id
   * @return Playlist
   */
  public function getPlaylist($playlist_id) {
    return $this->cmsRequest('GET', "/playlists/{$playlist_id}", Playlist::class);
  }

  /**
   * @param Playlist $playlist
   * @return Playlist
   */
  public function updatePlaylist(Playlist $playlist) {
    $playlist->fieldUnchanged('id');
    return $this->cmsRequest('PATCH', "/playlists/{$playlist->getId()}", Playlist::class, FALSE, $playlist);
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
   * @return Video[]
   */
  public function getVideosInPlaylist($playlist_id) {
    return $this->cmsRequest('GET', "/playlists/{$playlist_id}/videos", Video::class, TRUE);
  }

  /**
   * @return Subscription[]|null
   */
  public function getSubscriptions() {
    return $this->cmsRequest('GET', '/subscriptions', Subscription::class, TRUE);
  }

  /**
   * @param string $subscription_id
   * @return Subscription
   */
  public function getSubscription($subscription_id)  {
    return $this->cmsRequest('GET', "/subscriptions/{$subscription_id}", Subscription::class);
  }

  /**
   * @param SubscriptionRequest $request
   * @return Subscription|null
   */
  public function createSubscription(SubscriptionRequest $request) {
    return $this->cmsRequest('POST', '/subscriptions', Subscription::class, FALSE, $request);
  }

  /**
   * @param string $subscription_id
   */
  public function deleteSubscription($subscription_id) {
    $this->cmsRequest('DELETE', "/subscriptions/{$subscription_id}", NULL);
  }

}
