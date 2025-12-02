<?php

declare(strict_types=1);

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * Representation of all data related to a video object.
 *
 * @api
 */
class Video extends ObjectBase
{
    /**
     * The video id.
     */
    protected ?string $id = null;

    /**
     * The id of the account.
     */
    protected ?string $account_id = null;

    /**
     * It will be true if all processing of renditions and images is complete.
     */
    protected ?bool $complete = null;

    /**
     * ISO 8601 date-time string
     * Date-time video was added to the account; example: "2014-12-09T06:07:11.877Z".
     */
    protected ?string $created_at = null;

    /**
     * Array of cue_point objects.
     *
     * Marker at a precise time point in the duration of a video.
     * You can use cue points to trigger mid-roll ads or
     * to separate chapters or scenes in a long-form video.
     *
     * @var CuePoint[]
     */
    protected array $cue_points = [];

    /**
     * Map of custom field name:value pairs; only fields that have values are included.
     */
    protected array $custom_fields = [];

    /**
     * The short description of the video - 250 single-byte characters maximum.
     */
    protected ?string $description = null;

    /**
     * Length of the video in milliseconds.
     */
    protected ?int $duration = null;

    /**
     * Indicates whether ad requests are permitted for the video.
     */
    protected ?string $economics = null;

    /**
     * This is a reference to folder fields.
     */
    protected ?string $folder_id = null;

    /**
     * If geo-restriction is enabled for the account,
     * this array will contain geo objects which represents
     * geo-restriction properties for the video.
     */
    protected ?GEO $geo = null;

    /**
     * List of image objects.
     *
     * @var Image[]|null
     */
    protected ?array $images = null;

    /**
     * Describe a related link.
     */
    protected ?Link $link = null;

    /**
     * Maximum 5000 single-byte characters allowed.
     */
    protected ?string $long_description = null;

    /**
     * Video title - required field
     */
    protected ?string $name = null;

    /**
     * Any value that is unique within the account
     */
    protected ?string $reference_id = null;

    /**
     * Video schedule.
     */
    protected ?Schedule $schedule = null;

    /**
     * Sharing object.
     */
    protected ?Sharing $sharing = null;

    /**
     * Current status of the video: ACTIVE | INACTIVE | PENDING | DELETED.
     */
    protected ?string $state = null;

    /**
     * Array of tags (strings) added to the video.
     *
     * @var string[].
     */
    protected array $tags = [];

    /**
     * Array of text_track objects.
     *
     * @var TextTrack[]|null
     */
    protected ?array $text_tracks = [];

    /**
     * ISO 8601 date-time string
     * date-time video was last modified.
     * Example: "2015-01-13T17:45:21.977Z".
     */
    protected ?string $updated_at = null;

    /**
     * The mapping projection for 360° videos, e.g. "equirectangular"
     */
    protected ?string $projection = null;

    /**
     * ISO 8601 date-time string
     * Date-time video was published, can differ from created_at; example: "2014-12-09T06:07:11.877Z".
     */
    protected ?string $published_at = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'account_id');
        $this->applyProperty($json, 'complete');
        $this->applyProperty($json, 'created_at');
        $this->applyProperty($json, 'cue_points', null, CuePoint::class, true);
        $this->applyProperty($json, 'custom_fields');
        $this->applyProperty($json, 'description');
        $this->applyProperty($json, 'duration');
        $this->applyProperty($json, 'economics');
        $this->applyProperty($json, 'folder_id');
        $this->applyProperty($json, 'geo', null, GEO::class);
        $this->applyProperty($json, 'images', null, Image::class, true);
        $this->applyProperty($json, 'link', null, Link::class);
        $this->applyProperty($json, 'long_description');
        $this->applyProperty($json, 'name');
        $this->applyProperty($json, 'reference_id');
        $this->applyProperty($json, 'schedule', null, Schedule::class);
        $this->applyProperty($json, 'sharing', null, Sharing::class);
        $this->applyProperty($json, 'state');
        $this->applyProperty($json, 'tags');
        $this->applyProperty($json, 'text_tracks', null, TextTrack::class, true);
        $this->applyProperty($json, 'updated_at');
        $this->applyProperty($json, 'projection');
        $this->applyProperty($json, 'published_at');
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;
        $this->fieldChanged('id');
        return $this;
    }

    public function getAccountId(): ?string
    {
        return $this->account_id;
    }

    public function setAccountId(string $account_id): static
    {
        $this->account_id = $account_id;
        $this->fieldChanged('account_id');
        return $this;
    }

    public function getComplete(): ?bool
    {
        return $this->complete;
    }

    public function setComplete(bool $complete): static
    {
        $this->complete = $complete;
        $this->fieldChanged('complete');
        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): static
    {
        $this->created_at = $created_at;
        $this->fieldChanged('created_at');
        return $this;
    }

    /**
     * @return CuePoint[]
     */
    public function getCuePoints(): array
    {
        return $this->cue_points;
    }

    public function setCuePoints(array $cue_points): static
    {
        $this->cue_points = $cue_points;
        $this->fieldChanged('cue_points');
        return $this;
    }

    public function getCustomFields(): array
    {
        return $this->custom_fields;
    }

    public function setCustomFields(array $custom_fields): static
    {
        $this->custom_fields = $custom_fields;
        $this->fieldChanged('custom_fields');
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        $this->fieldChanged('description');
        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;
        $this->fieldChanged('duration');
        return $this;
    }

    public function getEconomics(): ?string
    {
        return $this->economics;
    }

    public function setEconomics(string $economics): static
    {
        $this->economics = $economics;
        $this->fieldChanged('economics');
        return $this;
    }

    public function getFolderId(): ?string
    {
        return $this->folder_id;
    }

    /**
     * @param string $folder_id
     * @return $this
     */
    public function setFolderId(string $folder_id): static
    {
        $this->folder_id = $folder_id;
        $this->fieldChanged('folder_id');
        return $this;
    }

    public function getGeo(): ?GEO
    {
        return $this->geo;
    }

    public function setGeo(GEO $geo = null): static
    {
        $this->geo = $geo;
        $this->fieldChanged('geo');
        return $this;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    /**
     * @param Image[] $images
     */
    public function setImages(array $images): static
    {
        $this->images = $images;
        $this->fieldChanged('images');
        return $this;
    }

    public function getLink(): ?Link
    {
        return $this->link;
    }

    public function setLink(Link $link): static
    {
        $this->link = $link;
        $this->fieldChanged('link');
        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->long_description;
    }

    public function setLongDescription(string $long_description): static
    {
        $this->long_description = $long_description;
        $this->fieldChanged('long_description');
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        $this->fieldChanged('name');
        return $this;
    }

    public function getReferenceId(): ?string
    {
        return $this->reference_id;
    }

    public function setReferenceId(string $reference_id): static
    {
        $this->reference_id = $reference_id;
        $this->fieldChanged('reference_id');
        return $this;
    }

    public function getSchedule(): ?Schedule
    {
        return $this->schedule;
    }

    public function setSchedule(Schedule $schedule): static
    {
        $this->schedule = $schedule;
        $this->fieldChanged('schedule');
        return $this;
    }

    public function getSharing(): ?Sharing
    {
        return $this->sharing;
    }

    public function setSharing(Sharing $sharing): static
    {
        $this->sharing = $sharing;
        $this->fieldChanged('sharing');
        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): static
    {
        $this->state = $state;
        $this->fieldChanged('state');
        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): static
    {
        $this->tags = $tags;
        $this->fieldChanged('tags');
        return $this;
    }

    public function getTextTracks(): ?array
    {
        return $this->text_tracks;
    }

    /**
     * @param TextTrack[] $text_tracks
     */
    public function setTextTracks(array $text_tracks): static
    {
        $this->text_tracks = $text_tracks;
        $this->fieldChanged('text_tracks');
        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): static
    {
        $this->updated_at = $updated_at;
        $this->fieldChanged('updated_at');
        return $this;
    }

    public function getProjection(): ?string
    {
        return $this->projection;
    }

    public function setProjection(string $projection): static
    {
        $this->projection = $projection;
        $this->fieldChanged('projection');
        return $this;
    }

    public function getPublishedAt(): ?string
    {
        return $this->published_at;
    }

    public function setPublishedAt(string $published_at): static
    {
        $this->published_at = $published_at;
        $this->fieldChanged('published_at');
        return $this;
    }
}
