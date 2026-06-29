<?php

namespace Brightcove\API\Request;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class IngestTextTrack extends ObjectBase
{
    protected string $url;

    protected string $srcLang;

    protected string $label;

    /**
     * allowed values: captions | subtitles | descriptions | chapters | metadata
     */
    protected string $kind;

    protected bool $default;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'url');
        $this->applyProperty($json, 'srclang');
        $this->applyProperty($json, 'label');
        $this->applyProperty($json, 'kind');
        $this->applyProperty($json, 'default');
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

    public function getSrcLang(): string
    {
        return $this->srcLang;
    }

    public function setSrcLang(string $srcLang): self
    {
        $this->srcLang = $srcLang;
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
