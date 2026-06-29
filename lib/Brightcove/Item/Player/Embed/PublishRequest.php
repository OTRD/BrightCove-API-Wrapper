<?php

namespace Brightcove\Item\Player\Embed;

use Brightcove\Item\ObjectBase;

/**
 * @api
 */
class PublishRequest extends ObjectBase
{
    protected string $author;

    protected string $buildLog;

    protected string $comment;

    protected string $elapsed_time;

    protected string $errorCode;

    protected string $queue_msg_id;

    protected string $requested_at;

    protected string $retries;

    protected string $status;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'author');
        $this->applyProperty($json, 'buildLog');
        $this->applyProperty($json, 'comment');
        $this->applyProperty($json, 'elapsed_time');
        $this->applyProperty($json, 'errorCode');
        $this->applyProperty($json, 'queue_msg_id');
        $this->applyProperty($json, 'requested_at');
        $this->applyProperty($json, 'retries');
        $this->applyProperty($json, 'status');
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function getBuildLog(): string
    {
        return $this->buildLog;
    }

    public function setBuildLog(string $buildLog): self
    {
        $this->buildLog = $buildLog;
        return $this;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    public function getElapsedTime(): string
    {
        return $this->elapsed_time;
    }

    public function setElapsedTime(string $elapsed_time): self
    {
        $this->elapsed_time = $elapsed_time;
        return $this;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    public function setErrorCode(string $errorCode): self
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    public function getQueueMsgId(): string
    {
        return $this->queue_msg_id;
    }

    public function setQueueMsgId(string $queue_msg_id): self
    {
        $this->queue_msg_id = $queue_msg_id;
        return $this;
    }

    public function getRequestedAt(): string
    {
        return $this->requested_at;
    }

    public function setRequestedAt(string $requested_at): self
    {
        $this->requested_at = $requested_at;
        return $this;
    }

    public function getRetries(): string
    {
        return $this->retries;
    }

    public function setRetries(string $retries): self
    {
        $this->retries = $retries;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }
}
