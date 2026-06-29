<?php

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class TextTrack extends ObjectBase
{
    protected string $id;

    protected string $src;

    protected string $srclang;

    protected string $label;

    protected string $kind;

    protected string $mime_type;

    protected string $asset_id;

    protected array $sources;

    protected bool $default;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'src');
        $this->applyProperty($json, 'srclang');
        $this->applyProperty($json, 'label');
        $this->applyProperty($json, 'kind');
        $this->applyProperty($json, 'mime_type');
        $this->applyProperty($json, 'asset_id');
        $this->applyProperty($json, 'sources', null, TextTrackSource::class, true);
        $this->applyProperty($json, 'default');
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

    public function getSrclang(): string
    {
        return $this->srclang;
    }

    public function setSrclang(string $srclang): self
    {
        $this->srclang = $srclang;
        $this->fieldChanged('srclang');
        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        $this->fieldChanged('label');
        return $this;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;
        $this->fieldChanged('kind');
        return $this;
    }

    public function getMimeType(): string
    {
        return $this->mime_type;
    }

    public function setMimeType(string $mime_type): self
    {
        $this->mime_type = $mime_type;
        $this->fieldChanged('mime_type');
        return $this;
    }

    public function getAssetId(): string
    {
        return $this->asset_id;
    }

    public function setAssetId(string $asset_id): self
    {
        $this->asset_id = $asset_id;
        $this->fieldChanged('asset_id');
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

    public function isDefault(): bool
    {
        return $this->default;
    }

    public function setDefault(bool $default): self
    {
        $this->default = $default;
        $this->fieldChanged('default');
        return $this;
    }
}
