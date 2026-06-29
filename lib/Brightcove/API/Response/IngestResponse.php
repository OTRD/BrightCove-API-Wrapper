<?php

namespace Brightcove\API\Response;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class IngestResponse extends ObjectBase
{
    protected string $id;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'id');
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
}
