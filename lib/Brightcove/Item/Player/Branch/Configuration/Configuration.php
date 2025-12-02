<?php

declare(strict_types=1);

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * Class Configuration
 *
 * @package Brightcove\Item\Player\Branch\Configuration
 * @api
 */
class Configuration extends ObjectBase
{
    protected string|int|null $autoadvance = null;
    protected bool $autoplay = false;
    protected ?CSS $css = null;
    protected ?Media $media = null;
    protected ?Player $player = null;
    protected bool $playlist = false;
    protected bool $playOnSelect = false;
    protected array $scripts = [];

    /**
     * @var string[]
     */
    protected array $stylesheets = [];

    /**
     * @var Plugin[]
     */
    protected array $plugins = [];

    /**
     * @var bool
     */
    protected bool $errors = false;

    /**
     * @var bool
     */
    protected bool $fullscreenControl = false;

    /**
     * @var array
     */
    protected array $languages = [];

    /**
     * @var bool
     */
    protected bool $loop = false;

    protected ?string $preload = null;
    protected string|bool|null $skin = null;
    protected array $techOrder = [];
    protected ?VideoCloud $video_cloud = null;
    protected ?StudioConfiguration $studio_configuration = null;
    protected ?string $embed_name = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'autoadvance');
        $this->applyProperty($json, 'autoplay');
        $this->applyProperty($json, 'css', null, CSS::class);
        $this->applyProperty($json, 'media', null, Media::class);
        $this->applyProperty($json, 'player', null, Player::class);
        $this->applyProperty($json, 'playlist');
        $this->applyProperty($json, 'playOnSelect');
        $this->applyProperty($json, 'scripts');
        $this->applyProperty($json, 'stylesheets');
        $this->applyProperty($json, 'plugins', null, Plugin::class, true);
        $this->applyProperty($json, 'errors');
        $this->applyProperty($json, 'fullscreenControl');
        $this->applyProperty($json, 'languages');
        $this->applyProperty($json, 'loop');
        $this->applyProperty($json, 'preload');
        $this->applyProperty($json, 'skin');
        $this->applyProperty($json, 'techOrder');
        $this->applyProperty($json, 'video_cloud', null, VideoCloud::class);
        $this->applyProperty($json, 'studio_configuration', null, StudioConfiguration::class);

        $this->applyProperty($json, 'embed_name');
    }

    public function getEmbedName(): ?string
    {
        return $this->embed_name;
    }

    public function setEmbedName(string $embed_name): static
    {
        $this->embed_name = $embed_name;
        $this->fieldChanged('embed_name');
        return $this;
    }

    public function getCss(): ?CSS
    {
        return $this->css;
    }

    public function setCss(CSS $css): static
    {
        $this->css = $css;
        $this->fieldChanged('css');
        return $this;
    }

    public function getMedia(): ?Media
    {
        return $this->media;
    }

    public function setMedia(Media $media): static
    {
        $this->media = $media;
        $this->fieldChanged('media');
        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(Player $player): static
    {
        $this->player = $player;
        $this->fieldChanged('player');
        return $this;
    }

    /**
     * @return string[]
     */
    public function getScripts(): array
    {
        return $this->scripts;
    }

    public function setScripts(array $scripts): static
    {
        $this->scripts = $scripts;
        $this->fieldChanged('scripts');
        return $this;
    }

    /**
     * @return string[]
     */
    public function getStylesheets(): array
    {
        return $this->stylesheets;
    }

    /**
     * @param string[] $stylesheets
     */
    public function setStylesheets(array $stylesheets): static
    {
        $this->stylesheets = $stylesheets;
        $this->fieldChanged('stylesheets');
        return $this;
    }

    /**
     * @return Plugin[]
     */
    public function getPlugins(): array
    {
        return $this->plugins;
    }

    /**
     * @param Plugin[] $plugins
     */
    public function setPlugins(array $plugins): static
    {
        $this->plugins = $plugins;
        $this->fieldChanged('plugins');
        return $this;
    }

    public function isErrors(): bool
    {
        return $this->errors;
    }

    public function setErrors(bool $errors): static
    {
        $this->errors = $errors;
        $this->fieldChanged('errors');
        return $this;
    }

    public function isFullscreenControl(): bool
    {
        return $this->fullscreenControl;
    }

    public function setFullscreenControl(bool $fullscreenControl): static
    {
        $this->fullscreenControl = $fullscreenControl;
        $this->fieldChanged('fullscreenControl');
        return $this;
    }

    public function getLanguages(): array
    {
        return $this->languages;
    }

    public function setLanguages(array $languages): static
    {
        $this->languages = $languages;
        $this->fieldChanged('languages');
        return $this;
    }

    public function isLoop(): bool
    {
        return $this->loop;
    }

    public function setLoop(bool $loop): static
    {
        $this->loop = $loop;
        $this->fieldChanged('loop');
        return $this;
    }

    public function getPreload(): ?string
    {
        return $this->preload;
    }

    public function setPreload(string $preload): static
    {
        $this->preload = $preload;
        $this->fieldChanged('preload');
        return $this;
    }

    public function getSkin(): string|bool|null
    {
        return $this->skin;
    }

    public function setSkin(string|bool $skin): static
    {
        $this->skin = $skin;
        $this->fieldChanged('skin');
        return $this;
    }

    public function getTechOrder(): array
    {
        return $this->techOrder;
    }

    public function setTechOrder(array $techOrder): static
    {
        $this->techOrder = $techOrder;
        $this->fieldChanged('techOrder');
        return $this;
    }

    public function getVideoCloud(): ?VideoCloud
    {
        return $this->video_cloud;
    }

    public function setVideoCloud(VideoCloud $video_cloud): static
    {
        $this->video_cloud = $video_cloud;
        $this->fieldChanged('video_cloud');
        return $this;
    }

    public function getStudioConfiguration(): ?StudioConfiguration
    {
        return $this->studio_configuration;
    }

    public function setStudioConfiguration(StudioConfiguration $studio_configuration): static
    {
        $this->studio_configuration = $studio_configuration;
        $this->fieldChanged('studio_configuration');
        return $this;
    }

    public function isAutoadvance(): string|int|null
    {
        return $this->autoadvance;
    }

    public function setAutoadvance(string|int $autoadvance): static
    {
        $this->autoadvance = $autoadvance;
        $this->fieldChanged('autoadvance');
        return $this;
    }

    /**
     * @return bool
     */
    public function isAutoplay(): bool
    {
        return $this->autoplay;
    }

    public function setAutoplay(bool $autoplay): static
    {
        $this->autoplay = $autoplay;
        $this->fieldChanged('autoplay');
        return $this;
    }

    public function isPlaylist(): bool
    {
        return $this->playlist;
    }

    public function setPlaylist(bool $playlist): static
    {
        $this->playlist = $playlist;
        $this->fieldChanged('playlist');
        return $this;
    }

    public function isPlayOnSelect(): bool
    {
        return $this->playOnSelect;
    }

    public function setPlayOnSelect(bool $playOnSelect): static
    {
        $this->playOnSelect = $playOnSelect;
        $this->fieldChanged('playOnSelect');
        return $this;
    }
}
