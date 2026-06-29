<?php

namespace Brightcove\Item\Player;

use Brightcove\Item\ObjectBase;
use Brightcove\Item\Player\Branch\BranchList;

/**
 * @api
 */
class Player extends ObjectBase
{
    protected string $accountId;

    protected BranchList $branches;

    protected string $description;

    protected string $id;

    protected string $name;

    protected string $created_at;

    protected string $url;

    protected int $embed_count;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'accountId');
        $this->applyProperty($json, 'branches', null, BranchList::class);
        $this->applyProperty($json, 'description');
        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'name');
        $this->applyProperty($json, 'created_at');
        $this->applyProperty($json, 'url');
        $this->applyProperty($json, 'embed_count');
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function setAccountId(string $accountId): self
    {
        $this->accountId = $accountId;
        $this->fieldChanged('accountId');
        return $this;
    }

    public function getBranches(): BranchList
    {
        return $this->branches;
    }

    public function setBranches(BranchList $branches): self
    {
        $this->branches = $branches;
        $this->fieldChanged('branches');
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

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): self
    {
        $this->created_at = $created_at;
        $this->fieldChanged('created_at');
        return $this;
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

    public function getEmbedCount(): int
    {
        return $this->embed_count;
    }

    public function setEmbedCount(int $embed_count): self
    {
        $this->embed_count = $embed_count;
        $this->fieldChanged('embed_count');
        return $this;
    }
}
