<?php

declare(strict_types=1);

namespace Brightcove\Item\Player;

use Brightcove\Item\ObjectBase;

/**
 * Class EmbedList
 *
 * @package Brightcove\Item\Player
 * @api
 */
class EmbedList extends ObjectBase
{
    /**
     * @var Embed[]
     */
    protected array $items = [];
    protected int $item_count = 0;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'items', null, Embed::class, true);
        $this->applyProperty($json, 'item_count');
    }

    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param Embed[] $items
     */
    public function setItems(array $items): static
    {
        $this->items = $items;
        return $this;
    }

    public function getItemCount(): int
    {
        return $this->item_count;
    }

    public function setItemCount(int $item_count): static
    {
        $this->item_count = $item_count;
        return $this;
    }
}
