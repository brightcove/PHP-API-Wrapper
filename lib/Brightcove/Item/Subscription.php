<?php

declare(strict_types=1);

namespace Brightcove\Item;

use Brightcove\API\Request\SubscriptionRequest;

/**
 * Class Subscription
 *
 * @package Brightcove\Item
 * @api
 */
class Subscription extends SubscriptionRequest
{
    protected ?string $id;
    protected ?string $service_account;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'service_account');
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;
        $this->fieldChanged('id');
        return $this;
    }

    public function getServiceAccount(): ?string
    {
        return $this->service_account;
    }

    public function setServiceAccount(string $service_account): static
    {
        $this->service_account = $service_account;
        $this->fieldChanged('service_account');
        return $this;
    }
}
