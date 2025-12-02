<?php

declare(strict_types=1);

namespace Brightcove\API\Request;

use Brightcove\Item\ObjectBase;

/**
 * Class IngestRequest
 *
 * @package Brightcove\API\Request
 * @api
 */
class IngestRequest extends ObjectBase
{
    protected ?IngestRequestMaster $master = null;
    protected ?string $profile = null;
    protected array $callbacks = [];
    protected ?IngestImage $poster = null;
    protected ?IngestImage $thumbnail = null;
    protected bool $capture_images = false;

    /**
     * @var IngestTextTrack[]
     */
    protected array $text_tracks = [];

    public function __construct()
    {
        $this->fieldAliases['capture_images'] = 'capture-images';
    }

    public static function createRequest($url, $profile): static
    {
        $request = new static();
        $request->setMaster(new IngestRequestMaster());
        $request->getMaster()->setUrl($url);
        $request->setProfile($profile);

        return $request;
    }

    public function getMaster(): ?IngestRequestMaster
    {
        return $this->master;
    }

    public function setMaster(IngestRequestMaster $master = null): static
    {
        $this->master = $master;
        $this->fieldChanged('master');
        return $this;
    }

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'master');
        $this->applyProperty($json, 'profile');
        $this->applyProperty($json, 'callbacks');
        $this->applyProperty($json, 'poster');
        $this->applyProperty($json, 'thumbnail');
        $this->applyProperty($json, 'capture_images');
        $this->applyProperty($json, 'text_tracks', null, IngestTextTrack::class, true);
    }

    public function getProfile(): ?string
    {
        return $this->profile;
    }

    public function setProfile(string $profile): static
    {
        $this->profile = $profile;
        $this->fieldChanged('profile');
        return $this;
    }

    public function getCallbacks(): array
    {
        return $this->callbacks;
    }

    public function setCallbacks(array $callbacks): static
    {
        $this->callbacks = $callbacks;
        $this->fieldChanged('callbacks');
        return $this;
    }

    public function getPoster(): ?IngestImage
    {
        return $this->poster;
    }

    public function setPoster(IngestImage $poster): static
    {
        $this->poster = $poster;
        $this->fieldChanged('poster');
        return $this;
    }

    public function getThumbnail(): ?IngestImage
    {
        return $this->thumbnail;
    }

    public function setThumbnail(IngestImage $thumbnail): static
    {
        $this->thumbnail = $thumbnail;
        $this->fieldChanged('thumbnail');
        return $this;
    }

    public function getCaptureImages(): bool
    {
        return $this->capture_images;
    }

    public function setCaptureImages(bool $capture_images): static
    {
        $this->capture_images = $capture_images;
        $this->fieldChanged('capture_images');
        return $this;
    }

    /**
     * @return IngestTextTrack[]
     */
    public function getTextTracks(): array
    {
        return $this->text_tracks;
    }

    /**
     * @param IngestTextTrack[] $text_tracks
     */
    public function setTextTracks(array $text_tracks): static
    {
        $this->text_tracks = $text_tracks;
        $this->fieldChanged('text_tracks');
        return $this;
    }
}
