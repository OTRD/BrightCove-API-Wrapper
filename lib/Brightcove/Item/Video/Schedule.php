<?php

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * Creates a schedule object, which represents when the video becomes available/unavailable
 *
 * @api
 */
class Schedule extends ObjectBase
{
    protected string $starts_at;

    protected string $ends_at;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'starts_at');
        $this->applyProperty($json, 'ends_at');
    }

    public function getStartsAt(): string
    {
        return $this->starts_at;
    }

    public function setStartsAt(string $starts_at): self
    {
        $this->starts_at = $starts_at;
        $this->fieldChanged('starts_at');
        return $this;
    }

    public function getEndsAt(): string
    {
        return $this->ends_at;
    }

    public function setEndsAt(string $ends_at): self
    {
        $this->ends_at = $ends_at;
        $this->fieldChanged('ends_at');
        return $this;
    }
}
