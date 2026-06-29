<?php

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class Track extends ObjectBase
{
    protected string $label;

    protected string $src;

    protected string $srcLang;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'label');
        $this->applyProperty($json, 'src');
        $this->applyProperty($json, 'srclang');
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function getSrc(): string
    {
        return $this->src;
    }

    public function setSrc(string $src): self
    {
        $this->src = $src;
        return $this;
    }

    public function getSrcLang(): string
    {
        return $this->srcLang;
    }

    public function setSrcLang(string $srcLang): self
    {
        $this->srcLang = $srcLang;
        return $this;
    }
}
