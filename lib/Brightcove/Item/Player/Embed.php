<?php

namespace Brightcove\Item\Player;

use Brightcove\Item\ObjectBase;
use Brightcove\Item\Player\Branch\BranchList;
use Brightcove\Item\Player\Embed\PublishRequest;

/**
 * @api
 */
class Embed extends ObjectBase
{
    protected BranchList $branches;

    protected string $embed_code;

    protected string $embed_in_page;

    protected string $id;

    protected string $name;

    protected string $preview_embed_code;

    protected PublishRequest $publish_request;

    protected string $preview_url;

    protected string $repository_url;

    protected string $url;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'branches', null, BranchList::class);
        $this->applyProperty($json, 'embed_code');
        $this->applyProperty($json, 'embed_in_page');
        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'name');
        $this->applyProperty($json, 'preview_embed_code');
        $this->applyProperty($json, 'publish_request', null, PublishRequest::class);
        $this->applyProperty($json, 'preview_url');
        $this->applyProperty($json, 'repository_url');
        $this->applyProperty($json, 'url');
    }

    public function getBranches(): BranchList
    {
        return $this->branches;
    }

    public function setBranches(BranchList $branches): self
    {
        $this->branches = $branches;
        return $this;
    }

    public function getEmbedCode(): string
    {
        return $this->embed_code;
    }

    public function setEmbedCode(string $embed_code): self
    {
        $this->embed_code = $embed_code;
        return $this;
    }

    public function getEmbedInPage(): string
    {
        return $this->embed_in_page;
    }

    public function setEmbedInPage(string $embed_in_page): self
    {
        $this->embed_in_page = $embed_in_page;
        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPreviewEmbedCode(): string
    {
        return $this->preview_embed_code;
    }

    public function setPreviewEmbedCode(string $preview_embed_code): self
    {
        $this->preview_embed_code = $preview_embed_code;
        return $this;
    }

    public function getPublishRequest(): PublishRequest
    {
        return $this->publish_request;
    }

    public function setPublishRequest(PublishRequest $publish_request): self
    {
        $this->publish_request = $publish_request;
        return $this;
    }

    public function getPreviewUrl(): string
    {
        return $this->preview_url;
    }

    public function setPreviewUrl(string $preview_url): self
    {
        $this->preview_url = $preview_url;
        return $this;
    }

    public function getRepositoryUrl(): string
    {
        return $this->repository_url;
    }

    public function setRepositoryUrl(string $repository_url): self
    {
        $this->repository_url = $repository_url;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }
}
