<?php

namespace Brightcove\Item;

/**
 * @api
 */
class CustomField extends ObjectBase
{
    protected string $id;

    protected string $display_name;

    protected string $description;

    protected bool $required;

    protected string $type;

    protected array $enum_values;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'display_name');
        $this->applyProperty($json, 'description');
        $this->applyProperty($json, 'required');
        $this->applyProperty($json, 'type');
        $this->applyProperty($json, 'enum_values');
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

    public function getDisplayName(): string
    {
        return $this->display_name;
    }

    public function setDisplayName(string $display_name): self
    {
        $this->display_name = $display_name;
        $this->fieldChanged('display_name');
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

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): self
    {
        $this->required = $required;
        $this->fieldChanged('required');
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        $this->fieldChanged('type');
        return $this;
    }

    public function getEnumValues(): array
    {
        return $this->enum_values;
    }

    public function setEnumValues(array $enum_values): self
    {
        $this->enum_values = $enum_values;
        $this->fieldChanged('enum_values');
        return $this;
    }
}
