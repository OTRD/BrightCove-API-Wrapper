<?php

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class PlayerTemplate extends ObjectBase
{
    protected string $name;

    protected string $version;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'name');
        $this->applyProperty($json, 'version');
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        $this->fieldChanged('name');
        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;
        $this->fieldChanged('version');
        return $this;
    }
}
