<?php

require_once 'brightcove.php';

class BrightcovePM extends BrightcoveAPI {

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

class BrightcovePlayerList extends BrightcoveObjectBase {
  /**
   * @var array
   */
  protected $items;

  /**
   * @var int
   */
  protected $item_count;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'items', NULL, BrightcovePlayer::class, TRUE);
    $this->applyProperty($json, 'item_count');
  }

  /**
   * @return BrightcovePlayer[]
   */
  public function getItems() {
    return $this->items;
  }

  /**
   * @param BrightcovePlayer[] $items
   * @return BrightcovePlayerList
   */
  public function setItems(array $items) {
    $this->items = $items;
    $this->fieldChanged('items');
    return $this;
  }

  /**
   * @return int
   */
  public function getItemCount() {
    return $this->item_count;
  }

  /**
   * @param int $item_count
   * @return BrightcovePlayerList
   */
  public function setItemCount($item_count) {
    $this->item_count = $item_count;
    $this->fieldChanged('item_count');
    return $this;
  }
}

class BrightcovePlayer extends BrightcoveObjectBase {
  /**
   * @var string
   */
  protected $accountId;

  /**
   * @var BrightcovePlayerBranchList
   */
  protected $branches;

  /**
   * @var string
   */
  protected $description;

  /**
   * @var string
   */
  protected $id;

  /**
   * @var string
   */
  protected $name;

  /**
   * @var string
   */
  protected $created_at;

  /**
   * @var string
   */
  protected $url;

  /**
   * @var int
   */
  protected $embed_count;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'accountId');
    $this->applyProperty($json, 'branches', NULL, BrightcovePlayerBranchList::class);
    $this->applyProperty($json, 'description');
    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'name');
    $this->applyProperty($json, 'created_at');
    $this->applyProperty($json, 'url');
    $this->applyProperty($json, 'embed_count');
  }

  /**
   * @return string
   */
  public function getAccountId() {
    return $this->accountId;
  }

  /**
   * @param string $accountId
   * @return BrightcovePlayer
   */
  public function setAccountId($accountId) {
    $this->accountId = $accountId;
    $this->fieldChanged('accountId');
    return $this;
  }

  /**
   * @return BrightcovePlayerBranchList
   */
  public function getBranches() {
    return $this->branches;
  }

  /**
   * @param BrightcovePlayerBranchList $branches
   * @return BrightcovePlayer
   */
  public function setBranches(BrightcovePlayerBranchList $branches) {
    $this->branches = $branches;
    $this->fieldChanged('branches');
    return $this;
  }

  /**
   * @return string
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * @param string $description
   * @return BrightcovePlayer
   */
  public function setDescription($description) {
    $this->description = $description;
    $this->fieldChanged('description');
    return $this;
  }

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   * @return BrightcovePlayer
   */
  public function setId($id) {
    $this->id = $id;
    $this->fieldChanged('id');
    return $this;
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param string $name
   * @return BrightcovePlayer
   */
  public function setName($name) {
    $this->name = $name;
    $this->fieldChanged('name');
    return $this;
  }

  /**
   * @return string
   */
  public function getCreatedAt() {
    return $this->created_at;
  }

  /**
   * @param string $created_at
   * @return BrightcovePlayer
   */
  public function setCreatedAt($created_at) {
    $this->created_at = $created_at;
    $this->fieldChanged('created_at');
    return $this;
  }

  /**
   * @return string
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * @param string $url
   * @return BrightcovePlayer
   */
  public function setUrl($url) {
    $this->url = $url;
    $this->fieldChanged('url');
    return $this;
  }

  /**
   * @return int
   */
  public function getEmbedCount() {
    return $this->embed_count;
  }

  /**
   * @param int $embed_count
   * @return BrightcovePlayer
   */
  public function setEmbedCount($embed_count) {
    $this->embed_count = $embed_count;
    $this->fieldChanged('embed_count');
    return $this;
  }
}

class BrightcovePlayerBranchList extends BrightcoveObjectBase {
  /**
   * @var BrightcovePlayerBranch
   */
  protected $master;

  /**
   * @var BrightcovePlayerBranch
   */
  protected $preview;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'master', NULL, BrightcovePlayerBranch::class);
    $this->applyProperty($json, 'preview', NULL, BrightcovePlayerBranch::class);
  }

  /**
   * @return BrightcovePlayerBranch
   */
  public function getMaster() {
    return $this->master;
  }

  /**
   * @param BrightcovePlayerBranch $master
   * @return BrightcovePlayerBranchList
   */
  public function setMaster(BrightcovePlayerBranch $master) {
    $this->master = $master;
    $this->fieldChanged('master');
    return $this;
  }

  /**
   * @return BrightcovePlayerBranch
   */
  public function getPreview() {
    return $this->preview;
  }

  /**
   * @param BrightcovePlayerBranch $preview
   * @return BrightcovePlayerBranchList
   */
  public function setPreview(BrightcovePlayerBranch $preview) {
    $this->preview = $preview;
    $this->fieldChanged('preview');
    return $this;
  }
}

class BrightcovePlayerBranch extends BrightcoveObjectBase {
  /**
   * @var BrightcovePlayerBranchConfiguration
   */
  protected $configuration;

  /**
   * @var string
   */
  protected $updated_at;

  /**
   * @var string
   */
  protected $preview_url;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'configuration', NULL, BrightcovePlayerBranchConfiguration::class);
    $this->applyProperty($json, 'updated_at');
    $this->applyProperty($json, 'preview_url');
  }

  /**
   * @return BrightcovePlayerBranchConfiguration
   */
  public function getConfiguration() {
    return $this->configuration;
  }

  /**
   * @param BrightcovePlayerBranchConfiguration $configuration
   * @return BrightcovePlayerBranch
   */
  public function setConfiguration(BrightcovePlayerBranchConfiguration $configuration) {
    $this->configuration = $configuration;
    $this->fieldChanged('configuration');
    return $this;
  }

  /**
   * @return string
   */
  public function getUpdatedAt() {
    return $this->updated_at;
  }

  /**
   * @param string $updated_at
   * @return BrightcovePlayerBranch
   */
  public function setUpdatedAt($updated_at) {
    $this->updated_at = $updated_at;
    return $this;
  }

  /**
   * @return string
   */
  public function getPreviewUrl() {
    return $this->preview_url;
  }

  /**
   * @param string $preview_url
   * @return BrightcovePlayerBranch
   */
  public function setPreviewUrl($preview_url) {
    $this->preview_url = $preview_url;
    return $this;
  }
}

class BrightcovePlayerBranchConfiguration extends BrightcoveObjectBase {
  /**
   * @var BrightcovePlayerBranchConfigurationMedia
   */
  protected $media;

  /**
   * @var BrightcovePlayerBranchConfigurationPlayer
   */
  protected $player;

  /**
   * @var string[]
   */
  protected $scripts;

  /**
   * @var string[]
   */
  protected $stylesheets;

  /**
   * @var BrightcovePlayerBranchConfigurationPlugin[]
   */
  protected $plugins;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'media', NULL, BrightcovePlayerBranchConfigurationMedia::class);
    $this->applyProperty($json, 'player', NULL, BrightcovePlayerBranchConfigurationPlayer::class);
    $this->applyProperty($json, 'scripts');
    $this->applyProperty($json, 'stylesheets');
    $this->applyProperty($json, 'plugins', NULL, BrightcovePlayerBranchConfigurationPlugin::class, TRUE);
  }

  /**
   * @return BrightcovePlayerBranchConfigurationMedia
   */
  public function getMedia() {
    return $this->media;
  }

  /**
   * @param BrightcovePlayerBranchConfigurationMedia $media
   * @return BrightcovePlayerBranchConfiguration
   */
  public function setMedia(BrightcovePlayerBranchConfigurationMedia $media) {
    $this->media = $media;
    $this->fieldChanged('media');
    return $this;
  }

  /**
   * @return BrightcovePlayerBranchConfigurationPlayer
   */
  public function getPlayer() {
    return $this->player;
  }

  /**
   * @param BrightcovePlayerBranchConfigurationPlayer $player
   * @return BrightcovePlayerBranchConfiguration
   */
  public function setPlayer(BrightcovePlayerBranchConfigurationPlayer $player) {
    $this->player = $player;
    $this->fieldChanged('player');
    return $this;
  }

  /**
   * @return string[]
   */
  public function getScripts() {
    return $this->scripts;
  }

  /**
   * @param string[] $scripts
   * @return BrightcovePlayerBranchConfiguration
   */
  public function setScripts(array $scripts) {
    $this->scripts = $scripts;
    $this->fieldChanged('scripts');
    return $this;
  }

  /**
   * @return string[]
   */
  public function getStylesheets() {
    return $this->stylesheets;
  }

  /**
   * @param string[] $stylesheets
   * @return BrightcovePlayerBranchConfiguration
   */
  public function setStylesheets(array $stylesheets) {
    $this->stylesheets = $stylesheets;
    $this->fieldChanged('stylesheets');
    return $this;
  }

  /**
   * @return BrightcovePlayerBranchConfigurationPlugin[]
   */
  public function getPlugins() {
    return $this->plugins;
  }

  /**
   * @param BrightcovePlayerBranchConfigurationPlugin[] $plugins
   * @return BrightcovePlayerBranchConfiguration
   */
  public function setPlugins(array $plugins) {
    $this->plugins = $plugins;
    $this->fieldChanged('plugins');
    return $this;
  }
}

class BrightcovePlayerBranchConfigurationMedia extends BrightcoveObjectBase {
  /**
   * @var string
   */
  protected $name;

  /**
   * @var string[]
   */
  protected $poster;

  /**
   * @var BrightcovePlayerBranchConfigurationMediaSource[]
   */
  protected $sources;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'name');
    $this->applyProperty($json, 'poster');
    $this->applyProperty($json, 'sources', NULL, BrightcovePlayerBranchConfigurationMediaSource::class, TRUE);
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param string $name
   * @return BrightcovePlayerBranchConfigurationMedia
   */
  public function setName($name) {
    $this->name = $name;
    $this->fieldChanged('name');
    return $this;
  }

  /**
   * @return array
   */
  public function getPoster() {
    return $this->poster;
  }

  /**
   * @param array $poster
   * @return BrightcovePlayerBranchConfigurationMedia
   */
  public function setPoster(array $poster) {
    $this->poster = $poster;
    $this->fieldChanged('poster');
    return $this;
  }

  /**
   * @return BrightcovePlayerBranchConfigurationMediaSource[]
   */
  public function getSources() {
    return $this->sources;
  }

  /**
   * @param BrightcovePlayerBranchConfigurationMediaSource[] $sources
   * @return BrightcovePlayerBranchConfigurationMedia
   */
  public function setSources(array $sources) {
    $this->sources = $sources;
    $this->fieldChanged('sources');
    return $this;
  }
}

class BrightcovePlayerBranchConfigurationMediaSource extends BrightcoveObjectBase {
  /**
   * @var string
   */
  protected $type;

  /**
   * @var string
   */
  protected $src;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'type');
    $this->applyProperty($json, 'src');
  }

  /**
   * @return string
   */
  public function getType() {
    return $this->type;
  }

  /**
   * @param string $type
   * @return BrightcovePlayerBranchConfigurationMediaSource
   */
  public function setType($type) {
    $this->type = $type;
    $this->fieldChanged('type');
    return $this;
  }

  /**
   * @return string
   */
  public function getSrc() {
    return $this->src;
  }

  /**
   * @param string $src
   * @return BrightcovePlayerBranchConfigurationMediaSource
   */
  public function setSrc($src) {
    $this->src = $src;
    $this->fieldChanged('src');
    return $this;
  }
}

class BrightcovePlayerBranchConfigurationPlayer extends BrightcoveObjectBase {
  /**
   * @var BrightcovePlayerBranchConfigurationPlayerTemplate
   */
  protected $template;

  /**
   * @var bool
   */
  protected $autoplay;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'template', NULL, BrightcovePlayerBranchConfigurationPlayerTemplate::class);
    $this->applyProperty($json, 'autoplay');
  }

  /**
   * @return BrightcovePlayerBranchConfigurationPlayerTemplate
   */
  public function getTemplate() {
    return $this->template;
  }

  /**
   * @param BrightcovePlayerBranchConfigurationPlayerTemplate $template
   * @return BrightcovePlayerBranchConfigurationPlayer
   */
  public function setTemplate(BrightcovePlayerBranchConfigurationPlayerTemplate $template) {
    $this->template = $template;
    $this->fieldChanged('template');
    return $this;
  }

  /**
   * @return boolean
   */
  public function isAutoplay() {
    return $this->autoplay;
  }

  /**
   * @param boolean $autoplay
   * @return BrightcovePlayerBranchConfigurationPlayer
   */
  public function setAutoplay($autoplay) {
    $this->autoplay = $autoplay;
    $this->fieldChanged('autoplay');
    return $this;
  }
}

class BrightcovePlayerBranchConfigurationPlayerTemplate extends BrightcoveObjectBase {
  /**
   * @var string
   */
  protected $name;

  /**
   * @var string
   */
  protected $version;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'name');
    $this->applyProperty($json, 'version');
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param string $name
   * @return BrightcovePlayerBranchConfigurationPlayerTemplate
   */
  public function setName($name) {
    $this->name = $name;
    $this->fieldChanged('name');
    return $this;
  }

  /**
   * @return string
   */
  public function getVersion() {
    return $this->version;
  }

  /**
   * @param string $version
   * @return BrightcovePlayerBranchConfigurationPlayerTemplate
   */
  public function setVersion($version) {
    $this->version = $version;
    $this->fieldChanged('version');
    return $this;
  }
}

class BrightcovePlayerBranchConfigurationPlugin extends BrightcoveObjectBase {
  /**
   * @var string
   */
  protected $name;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'name');
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param string $name
   * @return BrightcovePlayerBranchConfigurationPlugin
   */
  public function setName($name) {
    $this->name = $name;
    $this->fieldChanged('name');
    return $this;
  }
}

class BrightcovePlayerCreateResult extends BrightcoveObjectBase {
  /**
   * @var string
   */
  protected $id;

  /**
   * @var string
   */
  protected $url;

  /**
   * @var string
   */
  protected $embed_code;

  /**
   * @var string
   */
  protected $embed_in_page;

  /**
   * @var string
   */
  protected $preview_url;

  /**
   * @var string
   */
  protected $preview_embed_code;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'id');
    $this->applyProperty($json, 'url');
    $this->applyProperty($json, 'emebed_code');
    $this->applyProperty($json, 'embed_in_page');
    $this->applyProperty($json, 'preview_url');
    $this->applyProperty($json, 'preview_embed_code');
  }

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   * @return BrightcovePlayerCreateResult
   */
  public function setId($id) {
    $this->id = $id;
    $this->fieldChanged('id');
    return $this;
  }

  /**
   * @return string
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * @param string $url
   * @return BrightcovePlayerCreateResult
   */
  public function setUrl($url) {
    $this->url = $url;
    $this->fieldChanged('id');
    return $this;
  }

  /**
   * @return string
   */
  public function getEmbedCode() {
    return $this->embed_code;
  }

  /**
   * @param string $embed_code
   * @return BrightcovePlayerCreateResult
   */
  public function setEmbedCode($embed_code) {
    $this->embed_code = $embed_code;
    $this->fieldChanged('embed_code');
    return $this;
  }

  /**
   * @return string
   */
  public function getEmbedInPage() {
    return $this->embed_in_page;
  }

  /**
   * @param string $embed_in_page
   * @return BrightcovePlayerCreateResult
   */
  public function setEmbedInPage($embed_in_page) {
    $this->embed_in_page = $embed_in_page;
    $this->fieldChanged('embed_in_page');
    return $this;
  }

  /**
   * @return string
   */
  public function getPreviewUrl() {
    return $this->preview_url;
  }

  /**
   * @param string $preview_url
   * @return BrightcovePlayerCreateResult
   */
  public function setPreviewUrl($preview_url) {
    $this->preview_url = $preview_url;
    $this->fieldChanged('preview_url');
    return $this;
  }

  /**
   * @return string
   */
  public function getPreviewEmbedCode() {
    return $this->preview_embed_code;
  }

  /**
   * @param string $preview_embed_code
   * @return BrightcovePlayerCreateResult
   */
  public function setPreviewEmbedCode($preview_embed_code) {
    $this->preview_embed_code = $preview_embed_code;
    $this->fieldChanged('preview_embed_code');
    return $this;
  }
}

class BrightcovePlayerPublishComment extends BrightcoveObjectBase {
  /**
   * @var string
   */
  protected $comment;

  public function applyJSON(array $json) {
    parent::applyJSON($json);

    $this->applyProperty($json, 'comment');
  }

  /**
   * @return string
   */
  public function getComment() {
    return $this->comment;
  }

  /**
   * @param string $comment
   * @return BrightcovePlayerPublishComment
   */
  public function setComment($comment) {
    $this->comment = $comment;
    $this->fieldChanged('comment');
    return $this;
  }
}
