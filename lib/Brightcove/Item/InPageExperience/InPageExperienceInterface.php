<?php

declare(strict_types=1);

namespace Brightcove\Item\InPageExperience;

use Brightcove\Item\ObjectInterface;

/**
 * In-Page Experience entity interface.
 */
interface InPageExperienceInterface extends ObjectInterface
{
    /**
     * Gets the Video Cloud Account ID.
     */
    public function getAccountId(): int;

    /**
     * Gets the ISO-8601 date when the entity was created.
     */
    public function getCreatedAt(): string;

    /**
     * Gets the description.
     */
    public function getDescription(): string;

    /**
     * Gets the ID of the entity.
     */
    public function getId(): string;

    /**
     * Gets the name of the entity.
     */
    public function getName(): string;

    /**
     * Gets the current published status.
     */
    public function getPublishedStatus(): string;

    /**
     * Gets the ISO-8601 date when the entity was last updated.
     */
    public function getUpdatedAt(): string;

    /**
     * Sets the Account ID.
     */
    public function setAccountId(int $account_id): void;

    /**
     * Sets the Created At date, ISO-8601.
     */
    public function setCreatedAt(string $createdAt): void;

    /**
     * Sets the description.
     */
    public function setDescription(string $description): void;

    /**
     * Sets the ID.
     */
    public function setId(string $id): void;

    /**
     * Sets the name.
     */
    public function setName(string $name): void;

    /**
     * Sets the published status.
     */
    public function setPublishedStatus(string $publishedStatus): void;

    /**
     * Sets the Updated At date, ISO-8601.
     */
    public function setUpdatedAt(string $updatedAt): void;
}
