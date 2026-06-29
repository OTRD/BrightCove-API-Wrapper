<?php

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class Media extends ObjectBase
{
    protected string $src;

    protected array $poster;

    protected array $sources;

    protected array $tracks;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'src');
        $this->applyProperty($json, 'poster');
        $this->applyProperty($json, 'sources', null, MediaSource::class, true);
        $this->applyProperty($json, 'tracks', null, Track::class, true);
    }

    public function getSrc(): string
    {
        return $this->src;
    }

    public function setSrc(string $src): self
    {
        $this->src = $src;
        $this->fieldChanged('name');
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

    public function getTracks(): array
    {
        return $this->tracks;
    }

    public function setTracks(array $tracks): self
    {
        $this->tracks = $tracks;
        return $this;
    }
}
