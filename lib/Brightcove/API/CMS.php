<?php

declare(strict_types=1);

namespace Brightcove\API;

use Brightcove\API\Exception\CmsException;
use Brightcove\API\Request\SubscriptionRequest;
use Brightcove\Item\ObjectInterface;
use Brightcove\Item\Subscription;
use Brightcove\Item\Video\Video;
use Brightcove\Item\Video\Source;
use Brightcove\Item\Video\Images;
use Brightcove\Item\Playlist;
use Brightcove\Item\CustomFields;
use Brightcove\Type\ApiType;
use Brightcove\Type\HttpMethod;
use Brightcove\Type\HttpResponse;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Provides uncached read access to CMS data via request functions.
 *
 * @api
 */
class CMS extends API implements CmsInterface
{
    /**
     * {@inheritDoc}
     */
    public function listVideos(
        ?string $search = null,
        ?string $sort = null,
        ?int $limit = null,
        ?int $offset = null,
    ): array {
        $query = [];
        if ($search !== null) {
            $query['q'] = urlencode($search);
        }

        if ($sort != null) {
            $query['sort'] = $sort;
        }

        if ($limit) {
            $query['limit'] = $limit;
        }

        if ($offset) {
            $query['offset'] = $offset;
        }

        $query_parameters = $this->buildHttpQuery($query);

        return $this->sendRequest(HttpMethod::Get, "/videos{$query_parameters}", Video::class, true);
    }

    /**
     * {@inheritDoc}
     */
    public function countVideos(string $search = null): ?int
    {
        $query = '';
        if ($search !== null) {
            $query = $this->buildHttpQuery([
                'q' => urlencode($search)
            ]);
        }

        $result = $this->sendRequest(HttpMethod::Get, "/counts/videos{$query}");
        if ($result && !empty($result['count'])) {
            return (int)$result['count'];
        }
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getVideoImages(string $video_id): Images
    {
        return $this->sendRequest(HttpMethod::Get, "/videos/{$video_id}/images", Images::class);
    }

    /**
     * {@inheritDoc}
     */
    public function getVideoSources($video_id): array
    {
        return $this->sendRequest(HttpMethod::Get, "/videos/{$video_id}/sources", Source::class, true);
    }

    /**
     * {@inheritDoc}
     */
    public function getVideoFields(): CustomFields
    {
        return $this->sendRequest(HttpMethod::Get, "/video_fields", CustomFields::class);
    }

    /**
     * {@inheritDoc}
     */
    public function getVideo($video_id): Video
    {
        return $this->sendRequest(HttpMethod::Get, "/videos/{$video_id}", Video::class);
    }

    /**
     * {@inheritDoc}
     */
    public function createVideo(Video $video): Video
    {
        return $this->sendRequest(HttpMethod::Post, '/videos', Video::class, false, $video);
    }

    /**
     * {@inheritDoc}
     */
    public function updateVideo(Video $video): Video
    {
        $video->fieldUnchanged('account_id', 'id');
        return $this->sendRequest(HttpMethod::Patch, "/videos/{$video->getId()}", Video::class, false, $video);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteVideo($video_id): void
    {
        $this->sendRequest(HttpMethod::Delete, "/videos/{$video_id}");
    }

    /**
     * {@inheritDoc}
     */
    public function deleteVideoReferences(string $video_id): void
    {
        $this->sendRequest(HttpMethod::Delete, "/videos/{$video_id}/references");
    }

    /**
     * {@inheritDoc}
     */
    public function countPlaylists(): int
    {
        return $this->sendRequest(HttpMethod::Get, '/counts/playlists')['count'];
    }

    /**
     * {@inheritDoc}
     */
    public function listPlaylists($sort = null, ?int $limit = null, ?int $offset = null, $search = null): array
    {
        $query = [];
        if ($search !== null) {
            $query['q'] = urlencode($search);
        }

        if ($sort !== null) {
            $query['sort'] = $sort;
        }

        if ($limit !== null) {
            $query['limit'] = $limit;
        }

        if ($offset !== null) {
            $query['offset'] = $offset;
        }

        $query_parameters = $this->buildHttpQuery($query);

        return $this->sendRequest(HttpMethod::Get, "/playlists{$query_parameters}", Playlist::class, true);
    }

    /**
     * {@inheritDoc}
     */
    public function getPlaylistsByIds(array $playlist_ids): array
    {
        $promises = [];

        foreach ($playlist_ids as $playlist_id) {
            $promises[] = $this->client->sendAsyncRequest(
                HttpMethod::Get,
                self::API_VERSION,
                ApiType::CMS,
                $this->account,
                "/playlists/{$playlist_id}",
            );
        }

        $playlists = [];
        foreach ($this->client->collectPromiseResults($promises) as $response) {
            $value = $response->getBody()->getContents();
            $status_code = $response->getStatusCode();
            if ($status_code === HttpResponse::Ok->value) {
                $playlists[] = Playlist::fromJSON($value);
            } elseif ($status_code !== HttpResponse::NotFound->value) {
                // Skip not found, but throw an exception in any other case.
                throw new CmsException(sprintf('Failed to get playlist: %s', $value));
            }
        }

        return $playlists;
    }

    /**
     * {@inheritDoc}
     */
    public function createPlaylist(Playlist $playlist): Playlist
    {
        return $this->sendRequest(HttpMethod::Post, '/playlists', Playlist::class, false, $playlist);
    }

    /**
     * {@inheritDoc}
     */
    public function getPlaylist(string $playlist_id): Playlist
    {
        return $this->sendRequest(HttpMethod::Get, "/playlists/{$playlist_id}", Playlist::class);
    }

    /**
     * {@inheritDoc}
     */
    public function updatePlaylist(Playlist $playlist): Playlist
    {
        $playlist->fieldUnchanged('id');
        return $this->sendRequest(
            HttpMethod::Patch,
            "/playlists/{$playlist->getId()}",
            Playlist::class,
            false,
            $playlist,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function deletePlaylist(string $playlist_id): void
    {
        $this->sendRequest(HttpMethod::Delete, "/playlists/{$playlist_id}");
    }

    /**
     * {@inheritDoc}
     */
    public function getVideoCountInPlaylist(string $playlist_id): ?int
    {
        $result = $this->sendRequest(HttpMethod::Get, "/counts/playlists/{$playlist_id}/videos");
        if ($result && !empty($result['count'])) {
            return $result['count'];
        }
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getVideosInPlaylist(string $playlist_id): array
    {
        return $this->sendRequest(HttpMethod::Get, "/playlists/{$playlist_id}/videos", Video::class, true);
    }

    /**
     * {@inheritDoc}
     */
    public function getSubscriptions(): array
    {
        return $this->sendRequest(HttpMethod::Get, '/subscriptions', Subscription::class, true);
    }

    /**
     * {@inheritDoc}
     */
    public function getSubscription(string $subscription_id): Subscription
    {
        return $this->sendRequest(HttpMethod::Get, "/subscriptions/{$subscription_id}", Subscription::class);
    }

    /**
     * {@inheritDoc}
     */
    public function createSubscription(SubscriptionRequest $request): Subscription
    {
        return $this->sendRequest(HttpMethod::Post, '/subscriptions', Subscription::class, false, $request);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteSubscription(string $subscription_id): void
    {
        $this->sendRequest(HttpMethod::Delete, "/subscriptions/{$subscription_id}");
    }

    /**
     * Sends request using the CMS API.
     *
     * @template Response
     *
     * @param HttpMethod $method
     *   HTTP method.
     * @param string $endpoint
     *   API endpoint.
     * @param Response|class-string $result
     *   Response result.
     * @param bool $is_array
     *   If the result is an array.
     * @param ?ObjectInterface $post
     *   An ObjectInterface to post.
     *
     * @return Response|Response[]|null
     *   Response object.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    protected function sendRequest(
        HttpMethod $method,
        string $endpoint,
        mixed $result = null,
        bool $is_array = false,
        ?ObjectInterface $post = null,
    ): ObjectInterface|array|null {
        return $this->client->sendRequest(
            $method,
            self::API_VERSION,
            ApiType::CMS,
            $this->account,
            $endpoint,
            $result,
            $is_array,
            $post,
        );
    }
}
