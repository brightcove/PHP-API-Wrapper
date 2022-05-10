<?php

declare(strict_types=1);

namespace Brightcove\Item\InPageExperience;

use Brightcove\Item\ObjectBase;

/**
 * In-Page Experience entity list.
 */
final class InPageExperienceList extends ObjectBase implements InPageExperienceListInterface
{
    /**
     * List of entities.
     *
     * @var InPageExperienceInterface[]
     */
    protected $items = [];

    /**
     * {@inheritdoc}
     */
    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'items', null, InPageExperience::class, true);
    }

    /**
     * {@inheritdoc}
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * {@inheritdoc}
     */
    public function current(): InPageExperienceInterface
    {
        return current($this->items);
    }

    /**
     * {@inheritdoc}
     */
    public function next(): void
    {
        next($this->items);
    }

    /**
     * {@inheritdoc}
     */
    public function key(): ?int
    {
        return key($this->items);
    }

    /**
     * {@inheritdoc}
     */
    public function valid(): bool
    {
        return $this->key() !== null;
    }

    /**
     * {@inheritdoc}
     */
    public function rewind(): void
    {
        reset($this->items);
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return count($this->items);
    }
}
