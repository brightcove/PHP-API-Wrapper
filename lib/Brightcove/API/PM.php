<?php

declare(strict_types=1);

namespace Brightcove\API;

use Brightcove\Item\ObjectInterface;
use Brightcove\Item\Player\Branch\Configuration\Configuration;
use Brightcove\Item\Player\CreateData;
use Brightcove\Item\Player\CreateResult;
use Brightcove\Item\Player\Embed;
use Brightcove\Item\Player\EmbedList;
use Brightcove\Item\Player\Player;
use Brightcove\Item\Player\PlayerList;
use Brightcove\Item\Player\PublishComment;
use Brightcove\Item\Player\UpdateData;
use Brightcove\Type\ApiType;
use Brightcove\Type\HttpMethod;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Player Management API.
 *
 * @package Brightcove\API
 * @api
 */
class PM extends API implements PmInterface
{
    /**
     * {@inheritDoc}
     */
    public function listPlayers(): PlayerList
    {
        return $this->sendRequest(HttpMethod::Get, '/players', PlayerList::class);
    }

    /**
     * Sends request using the CMS API.
     *
     * @template Response
     *
     * @param HttpMethod $method
     *    HTTP method.
     * @param $endpoint
     *    API endpoint.
     * @param Response|class-string $result
     *    Response result.
     * @param bool $is_array
     *    If the result is an array.
     * @param ?ObjectInterface $post
     *    An ObjectInterface to post.
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
            '2',
            ApiType::Players,
            $this->account,
            $endpoint,
            $result,
            $is_array,
            $post,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function createPlayer(CreateData $player): CreateResult
    {
        return $this->sendRequest(HttpMethod::Post, '/players', CreateResult::class, false, $player);
    }

    /**
     * {@inheritDoc}
     */
    public function getPlayer(string $player_id): Player
    {
        return $this->sendRequest(HttpMethod::Get, "/players/{$player_id}", Player::class);
    }

    /**
     * {@inheritDoc}
     */
    public function updatePlayer(string $player_id, UpdateData $player): CreateResult
    {
        return $this->sendRequest(HttpMethod::Patch, "/players/{$player_id}", CreateResult::class, false, $player);
    }

    /**
     * {@inheritDoc}
     */
    public function deletePlayer(string $player_id): void
    {
        $this->sendRequest(HttpMethod::Delete, "/players/{$player_id}");
    }

    /**
     * {@inheritDoc}
     */
    public function getPlayerConfigurationBranch($player_id, $branch_name): Configuration
    {
        return $this->sendRequest(
            HttpMethod::Get,
            "/players/{$player_id}/configuration/{$branch_name}",
            Configuration::class,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function updatePlayerConfigurationBranch(string $player_id, Configuration $config): CreateResult
    {
        return $this->sendRequest(
            HttpMethod::Patch,
            "/players/{$player_id}/configuration",
            CreateResult::class,
            false,
            $config,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function publishPlayer(string $player_id, string $comment = ''): CreateResult
    {
        return $this->sendRequest(
            HttpMethod::Post,
            "/players/{$player_id}/publish",
            CreateResult::class,
            false,
            (new PublishComment())->setComment($comment),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getEmbed(string $player_id, string $embed_id): Embed
    {
        return $this->sendRequest(HttpMethod::Get, "/players/{$player_id}/embeds/{$embed_id}", Embed::class);
    }

    /**
     * {@inheritDoc}
     */
    public function listEmbeds(string $player_id): EmbedList
    {
        return $this->sendRequest(HttpMethod::Get, "/players/{$player_id}/embeds", EmbedList::class);
    }

    /**
     * {@inheritDoc}
     */
    public function createEmbed(string $player_id, CreateData $data): Embed
    {
        return $this->sendRequest(HttpMethod::Post, "/players/{$player_id}/embeds", Embed::class, false, $data);
    }

    /**
     * {@inheritDoc}
     */
    public function publishEmbed(string $player_id, string $embed_id, string $comment): Embed
    {
        return $this->sendRequest(
            HttpMethod::Post,
            "/players/{$player_id}/embeds/{$embed_id}/publish",
            Embed::class,
            false,
            (new PublishComment())->setComment($comment),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function deleteEmbed($player_id, $embed_id): void
    {
        $this->sendRequest(HttpMethod::Delete, "/players/{$player_id}/embeds/{$embed_id}");
    }

    /**
     * {@inheritDoc}
     */
    public function getEmbedConfigurationBranch(string $player_id, string $embed_id, string $branch): Configuration
    {
        return $this->sendRequest(
            HttpMethod::Get,
            "/players/{$player_id}/players/{$embed_id}/{$branch}",
            Configuration::class,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function updateEmbedConfigurationBranch(
        string $player_id,
        string $embed_id,
        Configuration $configuration,
    ): Configuration {
        return $this->sendRequest(
            HttpMethod::Patch,
            "/players/{$player_id}/embeds/{$embed_id}/configuration",
            Configuration::class,
            false,
            $configuration,
        );
    }
}
