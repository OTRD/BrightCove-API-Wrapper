<?php

namespace Brightcove\Item;

interface ObjectInterface
{
    public static function fromJSON(array|string $json): self;

    public function postJSON(): array;

    /**
     * This associative array contains the properties that have changed since the
     * last call of patchJSON() or the creation of the class.
     */
    public function patchJSON(): array;

    public function applyJSON(array $json): void;
}
