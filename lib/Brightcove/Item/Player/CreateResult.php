<?php

namespace Brightcove\Item\Player;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class CreateResult extends ObjectBase
{
    protected string $id;

    protected string $url;

    protected string $embed_code;

    protected string $embed_in_page;

    protected string $preview_url;

    protected string $preview_embed_code;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'url');
        $this->applyProperty($json, 'emebed_code');
        $this->applyProperty($json, 'embed_in_page');
        $this->applyProperty($json, 'preview_url');
        $this->applyProperty($json, 'preview_embed_code');
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

    public function getEmbedCode(): string
    {
        return $this->embed_code;
    }

    public function setEmbedCode(string $embed_code): self
    {
        $this->embed_code = $embed_code;
        $this->fieldChanged('embed_code');
        return $this;
    }

    public function getEmbedInPage(): string
    {
        return $this->embed_in_page;
    }

    public function setEmbedInPage(string $embed_in_page): self
    {
        $this->embed_in_page = $embed_in_page;
        $this->fieldChanged('embed_in_page');
        return $this;
    }

    public function getPreviewUrl(): string
    {
        return $this->preview_url;
    }

    public function setPreviewUrl(string $preview_url): self
    {
        $this->preview_url = $preview_url;
        $this->fieldChanged('preview_url');
        return $this;
    }

    public function getPreviewEmbedCode(): string
    {
        return $this->preview_embed_code;
    }

    public function setPreviewEmbedCode(string $preview_embed_code): self
    {
        $this->preview_embed_code = $preview_embed_code;
        $this->fieldChanged('preview_embed_code');
        return $this;
    }
}
