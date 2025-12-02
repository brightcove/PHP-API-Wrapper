<?php

declare(strict_types=1);

namespace Brightcove\Item\Player;

use Brightcove\Item\ObjectBase;

/**
 * Class PlayerList
 *
 * @package Brightcove\Item\Player
 * @api
 */
class PlayerList extends ObjectBase
{
    protected array $items = [];
    protected int $item_count = 0;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'items', null, Player::class, true);
        $this->applyProperty($json, 'item_count');
    }

    /**
     * @return Player[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param Player[] $items
     */
    public function setItems(array $items): static
    {
        $this->items = $items;
        $this->fieldChanged('items');
        return $this;
    }

    public function getItemCount(): int
    {
        return $this->item_count;
    }

    public function setItemCount(int $item_count): static
    {
        $this->item_count = $item_count;
        $this->fieldChanged('item_count');
        return $this;
    }
}
