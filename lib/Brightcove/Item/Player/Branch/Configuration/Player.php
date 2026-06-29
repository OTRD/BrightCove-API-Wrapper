<?php

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class Player extends ObjectBase
{
    protected PlayerTemplate $template;

    protected bool $inactive;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'template', null, PlayerTemplate::class);
        $this->applyProperty($json, 'autoplay');
    }

    public function getTemplate(): PlayerTemplate
    {
        return $this->template;
    }

    public function setTemplate(PlayerTemplate $template): self
    {
        $this->template = $template;
        $this->fieldChanged('template');
        return $this;
    }

    public function isInactive(): bool
    {
        return $this->inactive;
    }

    public function setInactive(bool $inactive): self
    {
        $this->inactive = $inactive;
        $this->fieldChanged('inactive');
        return $this;
    }
}
