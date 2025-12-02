<?php

declare(strict_types=1);

namespace Brightcove\API;

use Brightcove\API\Exception\CmsException;
use Brightcove\API\Request\SubscriptionRequest;
use Brightcove\Item\CustomFields;
use Brightcove\Item\Playlist;
use Brightcove\Item\Subscription;
use Brightcove\Item\Video\Images;
use Brightcove\Item\Video\Source;
use Brightcove\Item\Video\Video;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Interface for a CMS API.
 *
 * @see https://apis.support.brightcove.com/cms/references/reference.html
 */
interface CmsInterface
{
    /**
     * Creates a new subscription.
     *
     * @param SubscriptionRequest $request
     *   Subscription request.
     *
     * @return Subscription
     *   Created subscription.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function createSubscription(SubscriptionRequest $request): Subscription;

    /**
     * Creates a playlist.
     *
     * @param Playlist $playlist
     *   Playlist to create.
     *
     * @return Playlist
     *   Created playlist.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function createPlaylist(Playlist $playlist): Playlist;

    /**
     * Count playlists.
     *
     * @return int
     *   Number of playlist.
     *
     * @throws ClientExceptionInterface
     *    If the request is failed.
     */
    public function countPlaylists(): int;

    /**
     * Creates a new video.
     *
     * @return Video $video
     *   The new video.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function createVideo(Video $video): Video;

    /**
     * Returns the amount of a searched video's result.
     *
     * @param string|null $search
     *   Search string.
     *
     * @return int|null
     *   Count of videos.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function countVideos(string $search = null): ?int;

    /**
     * Deletes a playlist by ID.
     *
     * @param string $playlist_id
     *   Playlist ID.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function deletePlaylist(string $playlist_id): void;

    /**
     * Deletes a subscription by ID.
     *
     * @param string $subscription_id
     *   Subscription ID.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function deleteSubscription(string $subscription_id): void;

    /**
     * Deletes a video object.
     *
     * @param string $video_id
     *   Video ID.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function deleteVideo(string $video_id): void;

    /**
     * Deletes video references.
     *
     * @param string $video_id
     *   Video ID.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function deleteVideoReferences(string $video_id): void;

    /**
     * Gets a playlist by ID.
     *
     * @param string $playlist_id
     *   Playlist ID.
     *
     * @return Playlist
     *   Playlist.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function getPlaylist(string $playlist_id): Playlist;

    /**
     * Get playlists by the given IDs.
     *
     * @param array $playlist_ids
     *   Playlist IDs.
     *
     * @return Playlist[]
     *   List of playlists.
     *
     * @throws CmsException
     *   If one of the playlists failed to get, not found response excluded.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function getPlaylistsByIds(array $playlist_ids): array;

    /**
     * Gets a subscription by ID.
     *
     * @param string $subscription_id
     *   Subscription ID.
     *
     * @return Subscription
     *   Subscription.
     *
     * @throws ClientExceptionInterface
     *    If the request is failed.
     */
    public function getSubscription(string $subscription_id): Subscription;

    /**
     * Gets list of subscription.
     *
     * @return Subscription[]
     *   List of subscriptions.
     *
     * @throws ClientExceptionInterface
     *     If the request is failed.
     */
    public function getSubscriptions(): array;

    /**
     * Gets a single video.
     *
     * @return Video $video
     *   Video.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function getVideo($video_id): Video;

    /**
     * Gets video count in a playlist by ID.
     *
     * @param string $playlist_id
     *   Playlist ID.
     *
     * @return int|null
     *   Video count in playlist or NULL if not found.
     *
     * @throws ClientExceptionInterface
     *    If the request is failed.
     */
    public function getVideoCountInPlaylist(string $playlist_id): ?int;

    /**
     * Gets video fields.
     *
     * @return CustomFields
     *   List of custom video fields.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function getVideoFields(): CustomFields;

    /**
     * Gets images for a single video.
     *
     * @param string $video_id
     *   Video ID.
     *
     * @return Images
     *   List of images.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function getVideoImages(string $video_id): Images;

    /**
     * Gets a list of videos from a playlist by ID.
     *
     * @param string $playlist_id
     *   Playlist ID.
     *
     * @return Video[]
     *   List of videos from the playlist.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function getVideosInPlaylist(string $playlist_id): array;

    /**
     * Gets the sources for a single video.
     *
     * @return Source[]
     *   List of video sources.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function getVideoSources($video_id): array;

    /**
     * Gets playlists.
     *
     * @return Playlist[]
     *   List of playlists.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function listPlaylists($sort = null, ?int $limit = null, ?int $offset = null, $search = null): array;

    /**
     * Lists video objects with the given restrictions.
     *
     * @return Video[]
     *   List of videos.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function listVideos(
        ?string $search = null,
        ?string $sort = null,
        ?int $limit = null,
        ?int $offset = null
    ): array;

    /**
     * Updates a given playlist.
     *
     * @param Playlist $playlist
     *   Playlist to update.
     *
     * @return Playlist
     *   Updated playlist.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function updatePlaylist(Playlist $playlist): Playlist;

    /**
     * Updates a given video.
     *
     * @param Video $video
     *   Video to update.
     *
     * @return Video $video
     *   Updated video.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function updateVideo(Video $video): Video;
}
