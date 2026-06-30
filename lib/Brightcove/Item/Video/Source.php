<?php

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class Source extends ObjectBase
{
    protected ?string $id = null;

    protected ?string $app_name = null;

    protected ?string $stream_name = null;

    protected ?string $codec = null;

    protected ?string $container = null;

    protected ?int $encoding_rate = null;

    protected ?int $duration = null;

    protected ?int $height = null;

    protected ?int $width = null;

    protected ?int $size = null;

    protected ?string $uploaded_at = null;

    protected ?string $src = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'app_name');
        $this->applyProperty($json, 'stream_name');
        $this->applyProperty($json, 'codec');
        $this->applyProperty($json, 'container');
        $this->applyProperty($json, 'encoding_rate');
        $this->applyProperty($json, 'duration');
        $this->applyProperty($json, 'height');
        $this->applyProperty($json, 'width');
        $this->applyProperty($json, 'size');
        $this->applyProperty($json, 'uploaded_at');
        $this->applyProperty($json, 'src');
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function setSrc(string $src): self
    {
        $this->src = $src;
        $this->fieldChanged('src');
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        $this->fieldChanged('id');
        return $this;
    }

    public function getAppName(): ?string
    {
        return $this->app_name;
    }

    public function setAppName(string $app_name): self
    {
        $this->app_name = $app_name;
        $this->fieldChanged('app_name');
        return $this;
    }

    public function getStreamName(): ?string
    {
        return $this->stream_name;
    }

    public function setStreamName(string $stream_name): self
    {
        $this->stream_name = $stream_name;
        $this->fieldChanged('stream_name');
        return $this;
    }

    public function getCodec(): ?string
    {
        return $this->codec;
    }

    public function setCodec(string $codec): self
    {
        $this->codec = $codec;
        $this->fieldChanged('codec');
        return $this;
    }

    public function getContainer(): ?string
    {
        return $this->container;
    }

    public function setContainer(string $container): self
    {
        $this->container = $container;
        $this->fieldChanged('container');
        return $this;
    }

    public function getEncodingRate(): ?int
    {
        return $this->encoding_rate;
    }

    public function setEncodingRate(int $encoding_rate): self
    {
        $this->encoding_rate = $encoding_rate;
        $this->fieldChanged('encoding_rate');
        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;
        $this->fieldChanged('duration');
        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;
        $this->fieldChanged('height');
        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;
        $this->fieldChanged('width');
        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;
        $this->fieldChanged('size');
        return $this;
    }

    public function getUploadedAt(): ?string
    {
        return $this->uploaded_at;
    }

    public function setUploadedAt(string $uploaded_at): self
    {
        $this->uploaded_at = $uploaded_at;
        $this->fieldChanged('uploaded_at');
        return $this;
    }
}
