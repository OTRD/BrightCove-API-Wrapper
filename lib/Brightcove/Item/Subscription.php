<?php

namespace Brightcove\Item;

use Brightcove\API\Request\SubscriptionRequest;

/**
 * @api
 */
class Subscription extends SubscriptionRequest
{
    protected string $id;

    protected string $service_account;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'service_account');
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

    public function getServiceAccount(): string
    {
        return $this->service_account;
    }

    public function setServiceAccount(string $service_account): self
    {
        $this->service_account = $service_account;
        $this->fieldChanged('service_account');
        return $this;
    }
}
