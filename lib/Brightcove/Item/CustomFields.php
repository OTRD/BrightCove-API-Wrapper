<?php

namespace Brightcove\Item;

/**
 * @api
 */
class CustomFields extends ObjectBase
{
    protected int $max_custom_fields;

    protected array $custom_fields;

    protected array $standard_fields;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'max_custom_fields');
        $this->applyProperty($json, 'custom_fields', null, CustomField::class, true);
        $this->applyProperty($json, 'standard_fields', null, CustomField::class, true);
    }

    public function getMaxCustomFields(): int
    {
        return $this->max_custom_fields;
    }

    public function setMaxCustomFields(int $max_custom_fields): self
    {
        $this->max_custom_fields = $max_custom_fields;
        $this->fieldChanged('max_custom_fields');
        return $this;
    }

    public function getCustomFields(): array
    {
        return $this->custom_fields;
    }

    public function setCustomFields(array $custom_fields): self
    {
        $this->custom_fields = $custom_fields;
        $this->fieldChanged('custom_fields');
        return $this;
    }

    public function getStandardFields(): array
    {
        return $this->standard_fields;
    }

    public function setStandardFields(array $standard_fields): self
    {
        $this->standard_fields = $standard_fields;
        $this->fieldChanged('standard_fields');
        return $this;
    }
}
