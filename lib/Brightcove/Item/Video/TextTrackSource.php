<?php

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class TextTrackSource extends ObjectBase
{
    protected string $src;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'src');
    }

    public function getSrc(): string
    {
        return $this->src;
    }

    public function setSrc(string $src): self
    {
        $this->src = $src;
        $this->fieldChanged('src');
        return $this;
    }
}
