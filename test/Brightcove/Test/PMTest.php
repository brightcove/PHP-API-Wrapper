<?php

use Brightcove\Object\Player\Branch\Configuration\Media;
use Brightcove\Object\Player\Player;
use Brightcove\Test\TestBase;

define('BRIGHTCOVE_PLAYER_TEST_POSTER', 'http://upload.wikimedia.org/wikipedia/commons/c/c4/PM5544_with_non-PAL_signals.png');

class PMTest extends TestBase {

  public function testPlayerCreation() {
    $player = new Player();
    $player->setName($this->generateRandomString());

    $result = $this->pm->createPlayer($player);

    $this->assertNotEmpty($result);
    $this->assertNotEmpty($result->getId());

    return $this->pm->getPlayer($result->getId());
  }

  /**
   * @depends testPlayerCreation
   * @param Player $player
   * @return Player
   */
  public function testCheckPlayer(Player $player) {
    $playerID = $player->getId();
    $playerList = $this->pm->listPlayers();

    $match = 0;
    foreach ($playerList->getItems() as $p) {
      if ($p->getId() === $playerID) {
        $match++;
      }
    }

    $this->assertEquals(1, $match, 'Player found.');

    return $player;
  }

  /**
   * @depends testCheckPlayer
   * @param Player $player
   * @return Player
   */
  public function testUpdatePlayer(Player $player) {
    $desc = $this->generateRandomString(64);
    $player->setDescription($desc);
    $this->pm->updatePlayer($player);
    $player = $this->pm->getPlayer($player->getId());

    $this->assertEquals($desc, $player->getDescription(), "Player description has been updated successfully");

    return $player;
  }

  /**
   * @depends testUpdatePlayer
   * @param Player $player
   * @return Player
   */
  public function testUpdateAndPublishConfiguration(Player $player) {
    $master = $player->getBranches()->getMaster()->getConfiguration();
    $posterconf = ['highres' => BRIGHTCOVE_PLAYER_TEST_POSTER];
    $master->setMedia((new Media())->setPoster($posterconf));
    $this->pm->updatePlayerConfigurationBranch($player->getId(), $master);
    $player = $this->pm->getPlayer($player->getId());
    $this->assertEquals($posterconf, $player->getBranches()->getPreview()->getConfiguration()->getMedia()->getPoster());

    $this->pm->publishPlayer($player->getId());
    $player = $this->pm->getPlayer($player->getId());
    $this->assertEquals($posterconf, $player->getBranches()->getMaster()->getConfiguration()->getMedia()->getPoster());

    return $player;
  }

  /**
   * @depends testUpdateAndPublishConfiguration
   * @param Player $player
   */
  public function testDeletePlayer(Player $player) {
    $player_id = $player->getId();
    $this->pm->deletePlayer($player_id);

    $playerList = $this->pm->listPlayers();
    $match = 0;
    foreach ($playerList->getItems() as $p) {
      if ($p->getId() === $player_id) {
        $match++;
      }
    }

    $this->assertEquals(0, $match, "Player has been deleted successfully.");
  }
}
