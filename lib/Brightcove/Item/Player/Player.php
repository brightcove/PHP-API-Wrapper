<?php

declare(strict_types=1);

namespace Brightcove\Item\Player;

use Brightcove\Item\ObjectBase;
use Brightcove\Item\Player\Branch\BranchList;

/**
 * Class Player
 *
 * @package Brightcove\Item\Player
 * @api
 */
class Player extends ObjectBase
{
    protected ?string $accountId = null;
    protected ?BranchList $branches = null;
    protected ?string $description = null;
    protected ?string $id = null;
    protected ?string $name = null;
    protected ?string $created_at = null;
    protected ?string $url = null;
    protected ?int $embed_count = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'accountId');
        $this->applyProperty($json, 'branches', null, BranchList::class);
        $this->applyProperty($json, 'description');
        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'name');
        $this->applyProperty($json, 'created_at');
        $this->applyProperty($json, 'url');
        $this->applyProperty($json, 'embed_count');
    }

    public function getAccountId(): ?string
    {
        return $this->accountId;
    }

    public function setAccountId(string $accountId): static
    {
        $this->accountId = $accountId;
        $this->fieldChanged('accountId');
        return $this;
    }

    public function getBranches(): ?BranchList
    {
        return $this->branches;
    }

    public function setBranches(BranchList $branches): static
    {
        $this->branches = $branches;
        $this->fieldChanged('branches');
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;
        $this->fieldChanged('url');
        return $this;
    }

    public function getEmbedCount(): ?int
    {
        return $this->embed_count;
    }

    public function setEmbedCount(int $embed_count): static
    {
        $this->embed_count = $embed_count;
        $this->fieldChanged('embed_count');
        return $this;
    }
}
