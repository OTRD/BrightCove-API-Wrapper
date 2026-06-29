<?php

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class StudioConfigurationPlayer extends ObjectBase
{
    protected bool $adjusted;

    protected string $height;

    protected string $width;

    protected string $units;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'adjusted');
        $this->applyProperty($json, 'height');
        $this->applyProperty($json, 'width');
        $this->applyProperty($json, 'units');
    }

    public function isAdjusted(): bool
    {
        return $this->adjusted;
    }

    public function setAdjusted(bool $adjusted): self
    {
        $this->adjusted = $adjusted;
        $this->fieldChanged('adjusted');
        return $this;
    }

    public function getHeight(): string
    {
        return $this->height;
    }

    public function setHeight(string $height): self
    {
        $this->height = $height;
        $this->fieldChanged('height');
        return $this;
    }

    public function getWidth(): string
    {
        return $this->width;
    }

    public function setWidth(string $width): self
    {
        $this->width = $width;
        $this->fieldChanged('width');
        return $this;
    }

    public function getUnits(): string
    {
        return $this->units;
    }

    public function setUnits(string $units): self
    {
        $this->units = $units;
        $this->fieldChanged('units');
        return $this;
    }
}
