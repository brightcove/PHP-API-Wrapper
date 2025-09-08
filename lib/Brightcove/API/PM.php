<?php

namespace Brightcove\API;

use Brightcove\Item\Player\CreateData;
use Brightcove\Item\Player\Embed;
use Brightcove\Item\Player\EmbedList;
use Brightcove\Item\Player\PlayerList;
use Brightcove\Item\Player\CreateResult;
use Brightcove\Item\Player\PublishComment;
use Brightcove\Item\Player\Player;
use Brightcove\Item\Player\Branch\Configuration\Configuration;
use Brightcove\Item\Player\UpdateData;
use Brightcove\Type\ApiType;
use Brightcove\Type\HttpMethod;

/**
 * Class PM
 *
 * @package Brightcove\API
 * @api
 */
class PM extends API {

  protected function pmRequest(HttpMethod $method, $endpoint, $result, $is_array = FALSE, $post = NULL) {
    return $this->client->sendRequest($method, '2',ApiType::Players, $this->account, $endpoint, $result, $is_array, $post);
  }

  /**
   * @return PlayerList|null
   */
  public function listPlayers() {
    return $this->pmRequest(HttpMethod::Get, '/players', PlayerList::class, FALSE);
  }

  /**
   * @param CreateData $player
   *
   * @return CreateResult|null
   */
  public function createPlayer(CreateData $player) {
    return $this->pmRequest(HttpMethod::Post, '/players', CreateResult::class, FALSE, $player);
  }

  /**
   * @param string $player_id
   *
   * @return Player|null
   */
  public function getPlayer($player_id) {
    return $this->pmRequest(HttpMethod::Get, "/players/{$player_id}", Player::class);
  }

  /**
   *
   * @param string $player_id
   * @param UpdateData $player
   *
   * @return CreateResult|null
   */
  public function updatePlayer($player_id, UpdateData $player) {
    return $this->pmRequest(HttpMethod::Patch, "/players/{$player_id}", CreateResult::class, FALSE, $player);
  }

  public function deletePlayer($player_id) {
    return $this->pmRequest(HttpMethod::Delete, "/players/{$player_id}", NULL);
  }

  /**
   * @param string $player_id
   * @param string $branch_name
   *   Must be "master" or "preview"
   *
   * @return Configuration|null
   */
  public function getPlayerConfigurationBranch($player_id, $branch_name) {
    return $this->pmRequest(HttpMethod::Get, "/players/{$player_id}/configuration/{$branch_name}", Configuration::class);
  }

  /**
   * @param $player_id
   * @param Configuration $config
   *
   * @return CreateResult|null
   */
  public function updatePlayerConfigurationBranch($player_id, Configuration $config) {
    return $this->pmRequest(HttpMethod::Patch, "/players/{$player_id}/configuration", CreateResult::class, FALSE, $config);
  }

  /**
   * @param string $player_id
   * @param string $comment
   *
   * @return CreateResult|null
   */
  public function publishPlayer($player_id, $comment = '') {
    return $this->pmRequest(HttpMethod::Post, "/players/{$player_id}/publish", CreateResult::class, FALSE, (new PublishComment())->setComment($comment));
  }

  /**
   * @param string $player_id
   * @param string $embed_id
   *
   * @return Embed
   */
  public function getEmbed($player_id, $embed_id) {
    return $this->pmRequest(HttpMethod::Get, "/players/{$player_id}/embeds/{$embed_id}", Embed::class, FALSE);
  }

  /**
   * @param string $player_id
   *
   * @return EmbedList
   */
  public function listEmbeds($player_id) {
    return $this->pmRequest(HttpMethod::Get, "/players/{$player_id}/embeds", EmbedList::class);
  }

  /**
   * @param string $player_id
   * @param CreateData $data
   *
   * @return Embed
   */
  public function createEmbed($player_id, Configuration $data) {
    return $this->pmRequest(HttpMethod::Post, "/players/{$player_id}/embeds", Embed::class, FALSE, $data);
  }

  /**
   * @param string $player_id
   * @param string $embed_id
   * @param string $comment
   *
   * @return Embed
   */
  public function publishEmbed($player_id, $embed_id, $comment) {
    return $this->pmRequest(HttpMethod::Post, "/players/{$player_id}/embeds/{$embed_id}/publish", Embed::class, FALSE, (new PublishComment())->setComment($comment));
  }

  /**
   * @param string $player_id
   * @param string $embed_id
   *
   * @return null
   */
  public function deleteEmbed($player_id, $embed_id) {
    return $this->pmRequest(HttpMethod::Delete, "/players/{$player_id}/embeds/{$embed_id}", NULL);
  }

  /**
   * @param string $player_id
   * @param string $embed_id
   * @param string $branch
   *
   * @return Configuration
   */
  public function getEmbedConfigurationBranch($player_id, $embed_id, $branch) {
    return $this->pmRequest(HttpMethod::Get, "/players/{$player_id}/players/{$embed_id}/{$branch}", Configuration::class);
  }

  /**
   * @param string $player_id
   * @param string $embed_id
   * @param Configuration $configuration
   *
   * @return Configuration
   */
  public function updateEmbedConfigurationBranch($player_id, $embed_id, Configuration $configuration) {
    return $this->pmRequest(HttpMethod::Patch, "/players/{$player_id}/embeds/{$embed_id}/configuration", Configuration::class, FALSE, $configuration);
  }

}
