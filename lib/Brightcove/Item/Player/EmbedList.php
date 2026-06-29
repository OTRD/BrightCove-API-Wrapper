<?php

namespace Brightcove\Item\Player;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class EmbedList extends ObjectBase
{
    protected array $items;

    protected int $item_count;

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

    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    public function getItemCount(): int
    {
        return $this->item_count;
    }

    public function setItemCount(int $item_count): self
    {
        $this->item_count = $item_count;
        return $this;
    }
}
