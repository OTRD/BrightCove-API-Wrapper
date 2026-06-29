<?php

namespace Brightcove\API\Request;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class IngestImage extends ObjectBase
{
    protected string $url;

    protected int $width;

    protected int $height;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'url');
        $this->applyProperty($json, 'width');
        $this->applyProperty($json, 'height');
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

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;
        $this->fieldChanged('width');
        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;
        $this->fieldChanged('height');
        return $this;
    }
}
