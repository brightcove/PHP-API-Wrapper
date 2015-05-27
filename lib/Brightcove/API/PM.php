<?php

namespace Brightcove\API;

use Brightcove\API\API;

class PM extends API {

  protected function pmRequest($method, $endpoint, $result, $is_array = FALSE, $post = NULL) {
    return $this->client->request($method, 'players', $this->account, $endpoint, $result, $is_array, $post);
  }

  /**
   * @return BrightcovePlayerList|null
   */
  public function listPlayers() {
    return $this->pmRequest('GET', '/players', BrightcovePlayerList::class, FALSE);
  }

  /**
   * @param BrightcovePlayer $player
   * @return BrightcovePlayerCreateResult|null
   */
  public function createPlayer(BrightcovePlayer $player) {
    return $this->pmRequest('POST', '/players', BrightcovePlayerCreateResult::class, FALSE, $player);
  }

  /**
   * @param string $player_id
   * @return BrightcovePlayer|null
   */
  public function getPlayer($player_id) {
    return $this->pmRequest('GET', "/players/{$player_id}", BrightcovePlayer::class);
  }

  /**
   * @param BrightcovePlayer $player
   * @return BrightcovePlayerCreateResult|null
   */
  public function updatePlayer(BrightcovePlayer $player) {
    return $this->pmRequest('PATCH', "/players/{$player->getId()}", BrightcovePlayerCreateResult::class, FALSE, $player);
  }

  public function deletePlayer($player_id) {
    return $this->pmRequest('DELETE', "/players/{$player_id}", NULL);
  }

  /**
   * @param string $player_id
   * @param string $branch_name
   *   Must be "master" or "preview"
   * @return BrightcovePlayerBranchConfiguration|null
   */
  public function getPlayerConfigurationBranch($player_id, $branch_name) {
    return $this->pmRequest('GET', "/players/{$player_id}/configuration/{$branch_name}", BrightcovePlayerBranchConfiguration::class);
  }

  /**
   * @param $player_id
   * @param BrightcovePlayerBranchConfiguration $config
   * @return BrightcovePlayerCreateResult|null
   */
  public function updatePlayerConfigurationBranch($player_id, BrightcovePlayerBranchConfiguration $config) {
    return $this->pmRequest('PATCH', "/players/{$player_id}/configuration", BrightcovePlayerCreateResult::class, FALSE, $config);
  }

  /**
   * @param string $player_id
   * @param string $comment
   * @return BrightcovePlayerCreateResult|null
   */
  public function publishPlayer($player_id, $comment = '') {
    return $this->pmRequest('POST', "/players/{$player_id}/publish", BrightcovePlayerCreateResult::class, FALSE, (new BrightcovePlayerPublishComment())->setComment($comment));
  }

}