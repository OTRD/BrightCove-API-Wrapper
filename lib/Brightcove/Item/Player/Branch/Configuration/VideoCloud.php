<?php

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class VideoCloud extends ObjectBase
{
    protected string $policyKey;

    protected string $video;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'policyKey');
        $this->applyProperty($json, 'video');
    }

    public function getPolicyKey(): string
    {
        return $this->policyKey;
    }

    public function setPolicyKey(string $policyKey): self
    {
        $this->policyKey = $policyKey;
        $this->fieldChanged('policyKey');
        return $this;
    }

    public function getVideo(): string
    {
        return $this->video;
    }

    public function setVideo(string $video): self
    {
        $this->video = $video;
        $this->fieldChanged('video');
        return $this;
    }
}
