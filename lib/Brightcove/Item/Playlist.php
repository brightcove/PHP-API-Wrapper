<?php

declare(strict_types=1);

namespace Brightcove\Item;

/**
 * Class Playlist
 *
 * @package Brightcove\Item
 * @api
 */
class Playlist extends ObjectBase
{
    protected ?string $id = null;
    protected ?string $account = null;
    protected ?string $created_at = null;
    protected ?string $description = null;
    protected bool $favorite = false;
    protected ?int $limit = null;
    protected ?string $name = null;
    protected ?string $reference_id = null;
    protected ?string $search = null;
    protected ?string $type = null;
    protected ?string $updated_at = null;

    /**
     * Video IDs.
     */
    protected array $video_ids = [];

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'account');
        $this->applyProperty($json, 'created_at');
        $this->applyProperty($json, 'description');
        $this->applyProperty($json, 'favorite');
        $this->applyProperty($json, 'limit');
        $this->applyProperty($json, 'name');
        $this->applyProperty($json, 'reference_id');
        $this->applyProperty($json, 'search');
        $this->applyProperty($json, 'type');
        $this->applyProperty($json, 'updated_at');
        $this->applyProperty($json, 'video_ids');
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

    public function getAccount(): ?string
    {
        return $this->account;
    }

    public function setAccount(string $account): static
    {
        $this->account = $account;
        $this->fieldChanged('account');
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

    public function isFavorite(): bool
    {
        return $this->favorite;
    }

    public function setFavorite(bool $favorite): static
    {
        $this->favorite = $favorite;
        $this->fieldChanged('favorite');
        return $this;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): static
    {
        $this->limit = $limit;
        $this->fieldChanged('limit');
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

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function setSearch(string $search): static
    {
        $this->search = $search;
        $this->fieldChanged('search');
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;
        $this->fieldChanged('type');
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

    /**
     * Gets video IDs.
     *
     * @return array
     *   Video IDs.
     */
    public function getVideoIds(): array
    {
        return $this->video_ids;
    }

    /**
     * Set video IDs.
     *
     * @param array $video_ids
     *   List of video IDs.
     *
     * @return Playlist
     *   The current playlist.
     */
    public function setVideoIds(array $video_ids): static
    {
        $this->video_ids = $video_ids;
        $this->fieldChanged('video_ids');
        return $this;
    }
}
