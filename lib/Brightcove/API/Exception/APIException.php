<?php

namespace Brightcove\API\Exception;

use Exception;

/**
 * @api
 */
class APIException extends Exception
{
    protected string $responseBody;

    public function __construct(string $message = "", int $code = 0, ?Exception $previous = null, string $responseBody = '')
    {
        parent::__construct($message, $code, $previous);
        $this->setResponseBody($responseBody);
    }

    public function getResponseBody(): string
    {
        return $this->responseBody;
    }

    public function setResponseBody(string $responseBody): self
    {
        $this->responseBody = $responseBody;
        return $this;
    }
}
