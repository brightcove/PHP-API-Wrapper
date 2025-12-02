<?php

declare(strict_types=1);

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * Class Media
 *
 * @package Brightcove\Item\Player\Branch\Configuration
 * @api
 */
class Media extends ObjectBase
{
    protected ?string $src = null;

    /**
     * @var string[]
     */
    protected array $poster = [];

    /**
     * @var MediaSource[]
     */
    protected array $sources = [];

    /**
     * @var Track[]
     */
    protected array $tracks = [];

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'src');
        $this->applyProperty($json, 'poster');
        $this->applyProperty($json, 'sources', null, MediaSource::class, true);
        $this->applyProperty($json, 'tracks', null, Track::class, true);
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function setSrc(string $src): static
    {
        $this->src = $src;
        $this->fieldChanged('name');
        return $this;
    }

    /**
     * @return string[]
     */
    public function getPoster(): array
    {
        return $this->poster;
    }

    /**
     * @param string[] $poster
     */
    public function setPoster(array $poster): static
    {
        $this->poster = $poster;
        $this->fieldChanged('poster');
        return $this;
    }

    /**
     * @return MediaSource[]
     */
    public function getSources(): array
    {
        return $this->sources;
    }

    /**
     * @param MediaSource[] $sources
     */
    public function setSources(array $sources): static
    {
        $this->sources = $sources;
        $this->fieldChanged('sources');
        return $this;
    }

    /**
     * @return Track[]
     */
    public function getTracks(): array
    {
        return $this->tracks;
    }

    /**
     * @param Track[] $tracks
     */
    public function setTracks(array $tracks): static
    {
        $this->tracks = $tracks;
        return $this;
    }
}
