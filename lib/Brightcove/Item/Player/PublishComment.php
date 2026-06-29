<?php

namespace Brightcove\Item\Player;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class PublishComment extends ObjectBase
{
    protected string $comment;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'comment');
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;
        $this->fieldChanged('comment');
        return $this;
    }
}
