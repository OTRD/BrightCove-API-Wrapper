<?php

namespace Brightcove\API;

abstract class API
{
    protected string $account;

    protected Client $client;

    public function __construct(Client $client, string $account)
    {
        $this->client = $client;
        $this->account = $account;
    }
}
