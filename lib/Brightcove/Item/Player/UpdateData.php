<?php

namespace Brightcove\Item\Player;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class UpdateData extends ObjectBase
{
    protected string $name;

    protected string $description;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'name');
        $this->applyProperty($json, 'description');
    }

    /**
     * @return string
     */
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        $this->fieldChanged('description');
        return $this;
    }
}
