<?php

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class Configuration extends ObjectBase
{
    protected bool $autoAdvance;

    protected bool $autoPlay;

    protected CSS $css;

    protected Media $media;

    protected Player $player;

    protected bool $playlist;

    protected bool $playOnSelect;

    protected array $scripts;

    protected array $stylesheets;

    protected array $plugins;

    protected bool $errors;

    protected bool $fullscreenControl;

    protected array $languages;

    protected bool $loop;

    protected string $preload;

    protected string|bool $skin;

    protected array $techOrder;

    protected VideoCloud $videoCloud;

    protected StudioConfiguration $studioConfiguration;

    protected ?string $embedName;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'autoAdvance');
        $this->applyProperty($json, 'autoPlay');
        $this->applyProperty($json, 'css', null, CSS::class);
        $this->applyProperty($json, 'media', null, Media::class);
        $this->applyProperty($json, 'player', null, Player::class);
        $this->applyProperty($json, 'playlist');
        $this->applyProperty($json, 'playOnSelect');
        $this->applyProperty($json, 'scripts');
        $this->applyProperty($json, 'stylesheets');
        $this->applyProperty($json, 'plugins', null, Plugin::class, true);
        $this->applyProperty($json, 'errors');
        $this->applyProperty($json, 'fullscreenControl');
        $this->applyProperty($json, 'languages');
        $this->applyProperty($json, 'loop');
        $this->applyProperty($json, 'preload');
        $this->applyProperty($json, 'skin');
        $this->applyProperty($json, 'techOrder');
        $this->applyProperty($json, 'video_cloud', null, VideoCloud::class);
        $this->applyProperty($json, 'studio_configuration', null, StudioConfiguration::class);

        $this->applyProperty($json, 'embed_name');
    }

    public function getEmbedName(): ?string
    {
        return $this->embedName;
    }

    public function setEmbedName(string $embedName): self
    {
        $this->embedName = $embedName;
        $this->fieldChanged('embed_name');
        return $this;
    }

    public function getCss(): ?CSS
    {
        return $this->css;
    }

    public function setCss(CSS $css): self
    {
        $this->css = $css;
        $this->fieldChanged('css');
        return $this;
    }

    public function getMedia(): ?Media
    {
        return $this->media;
    }

    public function setMedia(Media $media): self
    {
        $this->media = $media;
        $this->fieldChanged('media');
        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(Player $player): self
    {
        $this->player = $player;
        $this->fieldChanged('player');
        return $this;
    }

    public function getScripts(): ?array
    {
        return $this->scripts;
    }

    public function setScripts(array $scripts): self
    {
        $this->scripts = $scripts;
        $this->fieldChanged('scripts');
        return $this;
    }

    public function getStylesheets(): ?array
    {
        return $this->stylesheets;
    }

    public function setStylesheets(array $stylesheets): self
    {
        $this->stylesheets = $stylesheets;
        $this->fieldChanged('stylesheets');
        return $this;
    }

    public function getPlugins(): ?array
    {
        return $this->plugins;
    }

    public function setPlugins(array $plugins): self
    {
        $this->plugins = $plugins;
        $this->fieldChanged('plugins');
        return $this;
    }

    public function isErrors(): bool
    {
        return $this->errors;
    }

    public function setErrors(bool $errors): self
    {
        $this->errors = $errors;
        $this->fieldChanged('errors');
        return $this;
    }

    public function isFullscreenControl(): bool
    {
        return $this->fullscreenControl;
    }

    public function setFullscreenControl(bool $fullscreenControl): self
    {
        $this->fullscreenControl = $fullscreenControl;
        $this->fieldChanged('fullscreenControl');
        return $this;
    }

    public function getLanguages(): ?array
    {
        return $this->languages;
    }

    public function setLanguages(array $languages): self
    {
        $this->languages = $languages;
        $this->fieldChanged('languages');
        return $this;
    }

    public function isLoop(): bool
    {
        return $this->loop;
    }

    public function setLoop(bool $loop): self
    {
        $this->loop = $loop;
        $this->fieldChanged('loop');
        return $this;
    }

    public function getPreload(): ?string
    {
        return $this->preload;
    }

    public function setPreload(string $preload): self
    {
        $this->preload = $preload;
        $this->fieldChanged('preload');
        return $this;
    }

    public function getSkin(): bool|string
    {
        return $this->skin;
    }

    public function setSkin(bool|string $skin): self
    {
        $this->skin = $skin;
        $this->fieldChanged('skin');
        return $this;
    }

    public function getTechOrder(): ?array
    {
        return $this->techOrder;
    }

    public function setTechOrder(array $techOrder): self
    {
        $this->techOrder = $techOrder;
        $this->fieldChanged('techOrder');
        return $this;
    }

    public function getVideoCloud(): ?VideoCloud
    {
        return $this->videoCloud;
    }

    public function setVideoCloud(VideoCloud $videoCloud): self
    {
        $this->videoCloud = $videoCloud;
        $this->fieldChanged('video_cloud');
        return $this;
    }

    public function getStudioConfiguration(): ?StudioConfiguration
    {
        return $this->studioConfiguration;
    }

    public function setStudioConfiguration(StudioConfiguration $studioConfiguration): self
    {
        $this->studioConfiguration = $studioConfiguration;
        $this->fieldChanged('studio_configuration');
        return $this;
    }

    public function isAutoAdvance(): bool
    {
        return $this->autoAdvance;
    }

    public function setAutoAdvance(bool $autoAdvance): self
    {
        $this->autoAdvance = $autoAdvance;
        $this->fieldChanged('autoAdvance');
        return $this;
    }

    public function isAutoPlay(): bool
    {
        return $this->autoPlay;
    }

    public function setAutoPlay(bool $autoPlay): self
    {
        $this->autoPlay = $autoPlay;
        $this->fieldChanged('autoPlay');
        return $this;
    }

    public function isPlaylist(): bool
    {
        return $this->playlist;
    }

    public function setPlaylist(bool $playlist): self
    {
        $this->playlist = $playlist;
        $this->fieldChanged('playlist');
        return $this;
    }

    public function isPlayOnSelect(): bool
    {
        return $this->playOnSelect;
    }

    public function setPlayOnSelect(bool $playOnSelect): self
    {
        $this->playOnSelect = $playOnSelect;
        $this->fieldChanged('playOnSelect');
        return $this;
    }
}
