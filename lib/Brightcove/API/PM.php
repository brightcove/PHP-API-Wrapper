<?php

namespace Brightcove\API;

use Brightcove\Object\Player\CreateData;
use Brightcove\Object\Player\Embed;
use Brightcove\Object\Player\EmbedList;
use Brightcove\Object\Player\PlayerList;
use Brightcove\Object\Player\CreateResult;
use Brightcove\Object\Player\PublishComment;
use Brightcove\Object\Player\Player;
use Brightcove\Object\Player\Branch\Configuration\Configuration;
use Brightcove\Object\Player\UpdateData;

/**
 * Class PM
 *
 * @package Brightcove\API
 * @api
 */
class PM extends API {

  protected function pmRequest($method, $endpoint, $result, $is_array = FALSE, $post = NULL) {
    return $this->client->request($method, '2','players', $this->account, $endpoint, $result, $is_array, $post);
  }

  /**
   * @return PlayerList|null
   */
  public function listPlayers() {
    return $this->pmRequest('GET', '/players', PlayerList::class, FALSE);
  }

  /**
   * @param CreateData $player
   *
   * @return CreateResult|null
   */
  public function createPlayer(CreateData $player) {
    return $this->pmRequest('POST', '/players', CreateResult::class, FALSE, $player);
  }

  /**
   * @param string $player_id
   *
   * @return Player|null
   */
  public function getPlayer($player_id) {
    return $this->pmRequest('GET', "/players/{$player_id}", Player::class);
  }

  /**
   *
   * @param string $player_id
   * @param UpdateData $player
   *
   * @return CreateResult|null
   */
  public function updatePlayer($player_id, UpdateData $player) {
    return $this->pmRequest('PATCH', "/players/{$player_id}", CreateResult::class, FALSE, $player);
  }

  public function deletePlayer($player_id) {
    return $this->pmRequest('DELETE', "/players/{$player_id}", NULL);
  }

  /**
   * @param string $player_id
   * @param string $branch_name
   *   Must be "master" or "preview"
   *
   * @return Configuration|null
   */
  public function getPlayerConfigurationBranch($player_id, $branch_name) {
    return $this->pmRequest('GET', "/players/{$player_id}/configuration/{$branch_name}", Configuration::class);
  }

  /**
   * @param $player_id
   * @param Configuration $config
   *
   * @return CreateResult|null
   */
  public function updatePlayerConfigurationBranch($player_id, Configuration $config) {
    return $this->pmRequest('PATCH', "/players/{$player_id}/configuration", CreateResult::class, FALSE, $config);
  }

  /**
   * @param string $player_id
   * @param string $comment
   *
   * @return CreateResult|null
   */
  public function publishPlayer($player_id, $comment = '') {
    return $this->pmRequest('POST', "/players/{$player_id}/publish", CreateResult::class, FALSE, (new PublishComment())->setComment($comment));
  }

  /**
   * @param string $player_id
   * @param string $embed_id
   *
   * @return Embed
   */
  public function getEmbed($player_id, $embed_id) {
    return $this->pmRequest('GET', "/players/{$player_id}/embeds/{$embed_id}", Embed::class, FALSE);
  }

  /**
   * @param string $player_id
   *
   * @return EmbedList
   */
  public function listEmbeds($player_id) {
    return $this->pmRequest('GET', "/players/{$player_id}/embeds", EmbedList::class);
  }

  /**
   * @param string $player_id
   * @param CreateData $data
   *
   * @return Embed
   */
  public function createEmbed($player_id, Configuration $data) {
    return $this->pmRequest('POST', "/players/{$player_id}/embeds", Embed::class, FALSE, $data);
  }

  /**
   * @param string $player_id
   * @param string $embed_id
   * @param string $comment
   *
   * @return Embed
   */
  public function publishEmbed($player_id, $embed_id, $comment) {
    return $this->pmRequest('POST', "/players/{$player_id}/embeds/{$embed_id}/publish", Embed::class, FALSE, (new PublishComment())->setComment($comment));
  }

  /**
   * @param string $player_id
   * @param string $embed_id
   *
   * @return null
   */
  public function deleteEmbed($player_id, $embed_id) {
    return $this->pmRequest('DELETE', "/players/{$player_id}/embeds/{$embed_id}", NULL);
  }

  /**
   * @param string $player_id
   * @param string $embed_id
   * @param string $branch
   *
   * @return Configuration
   */
  public function getEmbedConfigurationBranch($player_id, $embed_id, $branch) {
    return $this->pmRequest('GET', "/players/{$player_id}/players/{$embed_id}/{$branch}", Configuration::class);
  }

  /**
   * @param string $player_id
   * @param string $embed_id
   * @param Configuration $configuration
   *
   * @return Configuration
   */
  public function updateEmbedConfigurationBranch($player_id, $embed_id, Configuration $configuration) {
    return $this->pmRequest('PATCH', "/players/{$player_id}/embeds/{$embed_id}/configuration", Configuration::class, FALSE, $configuration);
  }

}
