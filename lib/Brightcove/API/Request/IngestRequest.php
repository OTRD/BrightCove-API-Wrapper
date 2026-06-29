<?php

namespace Brightcove\API\Request;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class IngestRequest extends ObjectBase
{
    protected IngestRequestMaster $master;

    protected string $profile;

    protected array $callbacks;

    protected IngestImage $poster;

    protected IngestImage $thumbnail;

    protected bool $captureImages;

    protected array $textTracks;

    public function __construct()
    {
        $this->fieldAliases["capture_images"] = "capture-images";
    }

    public static function createRequest(string $url, string $profile): self
    {
        $request = new self();
        $request->setMaster(new IngestRequestMaster());
        $request->getMaster()->setUrl($url);
        $request->setProfile($profile);

        return $request;
    }

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'master');
        $this->applyProperty($json, 'profile');
        $this->applyProperty($json, 'callbacks');
        $this->applyProperty($json, 'poster');
        $this->applyProperty($json, 'thumbnail');
        $this->applyProperty($json, 'capture_images');
        $this->applyProperty($json, 'text_tracks', null, IngestTextTrack::class, true);
    }

    public function getMaster(): IngestRequestMaster
    {
        return $this->master;
    }

    public function setMaster(?IngestRequestMaster $master = null): self
    {
        $this->master = $master;
        $this->fieldChanged('master');
        return $this;
    }

    public function getProfile(): string
    {
        return $this->profile;
    }

    public function setProfile(string $profile): self
    {
        $this->profile = $profile;
        $this->fieldChanged('profile');
        return $this;
    }

    public function getCallbacks(): array
    {
        return $this->callbacks;
    }

    public function setCallbacks(array $callbacks): self
    {
        $this->callbacks = $callbacks;
        $this->fieldChanged('callbacks');
        return $this;
    }

    public function getPoster(): IngestImage
    {
        return $this->poster;
    }

    public function setPoster(IngestImage $poster): self
    {
        $this->poster = $poster;
        $this->fieldChanged('poster');
        return $this;
    }

    public function getThumbnail(): IngestImage
    {
        return $this->thumbnail;
    }

    public function setThumbnail(IngestImage $thumbnail): self
    {
        $this->thumbnail = $thumbnail;
        $this->fieldChanged('thumbnail');
        return $this;
    }

    public function getCaptureImages(): bool
    {
        return $this->captureImages;
    }

    public function setCaptureImages(bool $captureImages): self
    {
        $this->captureImages = $captureImages;
        $this->fieldChanged('capture_images');
        return $this;
    }

    public function getTextTracks(): array
    {
        return $this->textTracks;
    }

    public function setTextTracks(array $textTracks): self
    {
        $this->textTracks = $textTracks;
        $this->fieldChanged('text_tracks');
        return $this;
    }
}
