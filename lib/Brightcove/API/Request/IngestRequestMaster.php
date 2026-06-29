<?php

namespace Brightcove\API\Request;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class IngestRequestMaster extends ObjectBase
{
    protected string $url;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'url');
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
}
