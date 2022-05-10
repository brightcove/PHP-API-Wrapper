<?php

declare(strict_types=1);

namespace Brightcove\Item\InPageExperience;

use Brightcove\Item\ObjectBase;

/**
 * In-Page Experience entity.
 */
final class InPageExperience extends ObjectBase implements InPageExperienceInterface
{
    /**
     * Video Cloud Account ID.
     *
     * @var int
     */
    protected $accountId;

    /**
     * Create date in ISO-8601 format.
     *
     * @var string
     */
    protected $createdAt;

    /**
     * Description
     *
     * @var string
     */
    protected $description;

    /**
     * Entity ID.
     *
     * @var string
     */
    protected $id;

    /**
     * Name of the entity.
     *
     * @var string
     */
    protected $name;

    /**
     * The current published status.
     *
     * Enum:
     *  - unpublished
     *  - success
     *  - publishing
     *  - unpublishing
     *  - inactive
     *  - failed
     *
     * @var string
     */
    protected $publishedStatus;

    /**
     * Update date in ISO-8601 format.
     *
     * @var string
     */
    protected $updatedAt;

    /**
     * {@inheritdoc}
     */
    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'accountId');
        $this->applyProperty($json, 'createdAt');
        $this->applyProperty($json, 'description');
        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'name');
        $this->applyProperty($json, 'publishedStatus');
        $this->applyProperty($json, 'updatedAt');
    }

    /**
     * {@inheritdoc}
     */
    public function getAccountId(): int
    {
        return $this->accountId;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getPublishedStatus(): string
    {
        return $this->publishedStatus;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setAccountId(int $account_id): void
    {
        $this->accountId = $account_id;
        $this->fieldChanged('accountId');
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
        $this->fieldChanged('createdAt');
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
        $this->fieldChanged('description');
    }

    /**
     * {@inheritdoc}
     */
    public function setId(string $id): void
    {
        $this->id = $id;
        $this->fieldChanged('id');
    }

    /**
     * {@inheritdoc}
     */
    public function setName(string $name): void
    {
        $this->name = $name;
        $this->fieldChanged('name');
    }

    /**
     * {@inheritdoc}
     */
    public function setPublishedStatus(string $publishedStatus): void
    {
        $this->publishedStatus = $publishedStatus;
        $this->fieldChanged('publishedStatus');
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
        $this->fieldChanged('updatedAt');
    }
}
