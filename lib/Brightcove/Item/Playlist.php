<?php

namespace Brightcove\Item;

/**
 * @api
 */
class Playlist extends ObjectBase
{
    protected string $id;

    protected string $account;

    protected string $created_at;

    protected string $description;

    protected bool $favorite;

    protected int $limit;

    protected string $name;

    protected string $reference_id;

    protected string $search;

    protected string $type;

    protected string $updated_at;

    protected array $video_ids;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'account');
        $this->applyProperty($json, 'created_at');
        $this->applyProperty($json, 'description');
        $this->applyProperty($json, 'favorite');
        $this->applyProperty($json, 'limit');
        $this->applyProperty($json, 'name');
        $this->applyProperty($json, 'reference_id');
        $this->applyProperty($json, 'search');
        $this->applyProperty($json, 'type');
        $this->applyProperty($json, 'updated_at');
        $this->applyProperty($json, 'video_ids');
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

    public function getAccount(): string
    {
        return $this->account;
    }

    public function setAccount(string $account): self
    {
        $this->account = $account;
        $this->fieldChanged('account');
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

    public function isFavorite(): bool
    {
        return $this->favorite;
    }

    public function setFavorite(bool $favorite): self
    {
        $this->favorite = $favorite;
        $this->fieldChanged('favorite');
        return $this;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
        $this->fieldChanged('limit');
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

    public function getReferenceId(): string
    {
        return $this->reference_id;
    }

    public function setReferenceId(string $reference_id): self
    {
        $this->reference_id = $reference_id;
        $this->fieldChanged('reference_id');
        return $this;
    }

    public function getSearch(): string
    {
        return $this->search;
    }

    public function setSearch(string $search): self
    {
        $this->search = $search;
        $this->fieldChanged('search');
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

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): self
    {
        $this->updated_at = $updated_at;
        $this->fieldChanged('updated_at');
        return $this;
    }

    public function getVideoIds(): array
    {
        return $this->video_ids;
    }

    public function setVideoIds(array $video_ids): self
    {
        $this->video_ids = $video_ids;
        $this->fieldChanged('video_ids');
        return $this;
    }
}
