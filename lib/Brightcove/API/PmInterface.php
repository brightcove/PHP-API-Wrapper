<?php

declare(strict_types=1);

namespace Brightcove\API;

use Brightcove\Item\Player\Branch\Configuration\Configuration;
use Brightcove\Item\Player\CreateData;
use Brightcove\Item\Player\CreateResult;
use Brightcove\Item\Player\Embed;
use Brightcove\Item\Player\EmbedList;
use Brightcove\Item\Player\Player;
use Brightcove\Item\Player\PlayerList;
use Brightcove\Item\Player\UpdateData;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Interface for Player Management API.
 *
 * @see https://apis.support.brightcove.com/player-management/references/reference.html
 */
interface PmInterface
{
    /**
     * Creates an embed.
     *
     * @param string $player_id
     *   Player ID.
     * @param CreateData $data
     *   Embed to create.
     *
     * @return Embed
     *   Created embed.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function createEmbed(string $player_id, CreateData $data): Embed;

    /**
     * Creates a player.
     *
     * @param CreateData $player
     *   Player to create.
     *
     * @return CreateResult
     *   Created player.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function createPlayer(CreateData $player): CreateResult;

    /**
     * Deletes an embed.
     *
     * @param string $player_id
     *   Player ID.
     * @param string $embed_id
     *   Embed ID.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function deleteEmbed(string $player_id, string $embed_id): void;

    /**
     * Delete player.
     *
     * @param string $player_id
     *   Player ID.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function deletePlayer(string $player_id): void;

    /**
     * Gets embed.
     *
     * @param string $player_id
     *   Player ID.
     * @param string $embed_id
     *   Embed ID.
     *
     * @return Embed
     *   Embed.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function getEmbed(string $player_id, string $embed_id): Embed;

    /**
     * Gets embed configuration.
     *
     * @param string $player_id
     *   Player ID.
     * @param string $embed_id
     *   Embed ID.
     * @param string $branch
     *   Branch.
     *
     * @return Configuration
     *   Embed configuration.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function getEmbedConfigurationBranch(string $player_id, string $embed_id, string $branch): Configuration;

    /**
     * Gets player by ID.
     *
     * @param string $player_id
     *   Player ID.
     *
     * @return Player
     *   Player.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function getPlayer(string $player_id): Player;

    /**
     * Get player configuration branch.
     *
     * @param string $player_id
     *   Player ID.
     * @param string $branch_name
     *   Branch name, must be "master" or "preview".
     *
     * @return Configuration
     *   Configuration.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function getPlayerConfigurationBranch(string $player_id, string $branch_name): Configuration;

    /**
     * List embeds.
     *
     * @param string $player_id
     *   Player ID.
     *
     * @return EmbedList
     *   List of embed.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function listEmbeds(string $player_id): EmbedList;

    /**
     * Get the list of players.
     *
     * @return PlayerList
     *   List of players.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function listPlayers(): PlayerList;

    /**
     * Published embed.
     *
     * @param string $player_id
     *   Player ID.
     * @param string $embed_id
     *   Embed ID.
     * @param string $comment
     *   Embed comment.
     *
     * @return Embed
     *   Published embed.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function publishEmbed(string $player_id, string $embed_id, string $comment): Embed;

    /**
     * Publishes player.
     *
     * @param string $player_id
     *   Player ID.
     * @param string $comment
     *   Publication comment.
     *
     * @return CreateResult
     *   Published player.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function publishPlayer(string $player_id, string $comment = ''): CreateResult;

    /**
     * Updates embed configuration.
     *
     * @param string $player_id
     *   Player ID.
     * @param string $embed_id
     *   Embed ID.
     * @param Configuration $configuration
     *   Embed configuration to update.
     *
     * @return Configuration
     *   Updated embed configuration.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function updateEmbedConfigurationBranch(
        string $player_id,
        string $embed_id,
        Configuration $configuration,
    ): Configuration;

    /**
     * Updates a given player.
     *
     * @param string $player_id
     *   Player ID.
     * @param UpdateData $player
     *   Player to update.
     *
     * @return CreateResult
     *   Updated player.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function updatePlayer(string $player_id, UpdateData $player): CreateResult;

    /**
     * Updates player configuration branch.
     *
     * @params string $player_id
     *   Player ID.
     * @param Configuration $config
     *   Configuration to update.
     *
     * @return CreateResult
     *   Updated configuration.
     *
     * @throws ClientExceptionInterface
     *    If the request is failed.
     */
    public function updatePlayerConfigurationBranch(string $player_id, Configuration $config): CreateResult;
}
