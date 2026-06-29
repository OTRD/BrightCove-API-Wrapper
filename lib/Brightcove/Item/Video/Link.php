<?php

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * Creates a link object which has two separated string field.
 *
 * @api
 */
class Link extends ObjectBase
{
    protected string $text;

    protected string $url;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'url');
        $this->applyProperty($json, 'text');
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;
        $this->fieldChanged('text');
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        $this->fieldChanged('url');
        return $this;
    }
}
