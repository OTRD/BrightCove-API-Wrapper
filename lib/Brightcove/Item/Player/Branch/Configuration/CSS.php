<?php

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class CSS extends ObjectBase
{
    protected string $controlBarColor;

    protected string $controlColor;

    protected string $progressColor;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'controlBarColor');
        $this->applyProperty($json, 'controlColor');
        $this->applyProperty($json, 'progressColor');
    }

    public function getControlBarColor(): string
    {
        return $this->controlBarColor;
    }

    public function setControlBarColor(string $controlBarColor): self
    {
        $this->controlBarColor = $controlBarColor;
        $this->fieldChanged('controlBarColor');
        return $this;
    }

    public function getControlColor(): string
    {
        return $this->controlColor;
    }

    public function setControlColor(string $controlColor): self
    {
        $this->controlColor = $controlColor;
        $this->fieldChanged('controlColor');
        return $this;
    }

    public function getProgressColor(): string
    {
        return $this->progressColor;
    }

    public function setProgressColor(string $progressColor): self
    {
        $this->progressColor = $progressColor;
        $this->fieldChanged('progressColor');
        return $this;
    }
}
