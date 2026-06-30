<?php

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * Provides a poster or a thumbnail preview.
 *
 * @api
 */
class Images extends ObjectBase
{
    protected array $thumbnail;

    protected array $poster;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'thumbnail');
        $this->applyProperty($json, 'poster');
    }

    public function getThumbnail(): array
    {
        return $this->thumbnail;
    }

    public function setThumbnail(array $thumbnail): self
    {
        $this->thumbnail = $thumbnail;
        $this->fieldChanged('thumbnail');
        return $this;
    }

    public function getPoster(): array
    {
        return $this->poster;
    }

    public function setPoster(array $poster): self
    {
        $this->poster = $poster;
        $this->fieldChanged('poster');
        return $this;
    }
}
