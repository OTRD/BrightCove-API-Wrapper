<?php

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * An image what represents a video, only can be thumbnail or poster.
 *
 * @api
 */
class Image extends ObjectBase
{
    protected string $id;

    protected string $src;

    protected array $sources;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'src');
        $this->applyProperty($json, 'sources');
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        $this->fieldChanged('id');
        return $this;
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

    public function getSources(): array
    {
        return $this->sources;
    }

    public function setSources(array $sources): self
    {
        $this->sources = $sources;
        $this->fieldChanged('sources');
        return $this;
    }
}
