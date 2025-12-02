<?php

declare(strict_types=1);

namespace Brightcove\API;

use Brightcove\API\Exception\ApiException;
use Brightcove\Item\InPageExperience\InPageExperienceInterface as InPageExperienceItemInterface;
use Brightcove\Item\InPageExperience\InPageExperienceListInterface;
use Brightcove\Type\SortInterface;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * In-Page Experience API interface.
 */
interface InPageExperienceInterface
{
    /**
     * Deletes an entity with the given ID.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function delete(string $id): void;

    /**
     * Gets an entity with the given ID.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function get(string $id): InPageExperienceItemInterface;

    /**
     * Gets all entities.
     *
     * @param string|null $search
     *   A string to search for in name or description.
     * @param SortInterface|null $sort
     *   To sort the results by a specific field.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    public function getAll(string $search = null, SortInterface $sort = null): InPageExperienceListInterface;
}
