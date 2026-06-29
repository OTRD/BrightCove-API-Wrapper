<?php

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class StudioConfiguration extends ObjectBase
{
    protected StudioConfigurationPlayer $player;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'player', null, StudioConfigurationPlayer::class);
    }

    public function getPlayer(): StudioConfigurationPlayer
    {
        return $this->player;
    }

    public function setPlayer(StudioConfigurationPlayer $player): self
    {
        $this->player = $player;
        $this->fieldChanged('player');
        return $this;
    }
}
