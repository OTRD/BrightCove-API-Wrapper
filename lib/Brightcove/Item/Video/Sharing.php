<?php

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class Sharing extends ObjectBase
{
    protected bool $by_external_acct = false;

    protected string $by_id;

    protected string $source_id;

    protected bool $to_external_acct = false;

    protected bool $by_reference = false;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'by_external_acct');
        $this->applyProperty($json, 'by_id');
        $this->applyProperty($json, 'source_id');
        $this->applyProperty($json, 'to_external_acct');
        $this->applyProperty($json, 'by_reference');
    }

    public function getByExternalAcct(): bool
    {
        return $this->by_external_acct;
    }

    public function setByExternalAcct(bool $byExternalAcct): self
    {
        $this->by_external_acct = $byExternalAcct;
        $this->fieldChanged('by_external_acct');
        return $this;
    }

    public function getById(): string
    {
        return $this->by_id;
    }

    public function setById(string $byId): self
    {
        $this->by_id = $byId;
        $this->fieldChanged('by_id');
        return $this;
    }

    public function getSourceId(): string
    {
        return $this->source_id;
    }

    public function setSourceId(string $sourceId): self
    {
        $this->source_id = $sourceId;
        $this->fieldChanged('source_id');
        return $this;
    }

    /**
     * @return boolean
     */
    public function getToExternalAcct(): bool
    {
        return $this->to_external_acct;
    }

    public function setToExternalAcct(bool $toExternalAcct): self
    {
        $this->to_external_acct = $toExternalAcct;
        $this->fieldChanged('to_external_acct');
        return $this;
    }

    public function getByReference(): bool
    {
        return $this->by_reference;
    }

    public function setByReference(bool $byReference): self
    {
        $this->by_reference = $byReference;
        $this->fieldChanged('by_reference');
        return $this;
    }
}
