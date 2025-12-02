<?php

declare(strict_types=1);

namespace Brightcove\API\Request;

use Brightcove\Item\ObjectBase;

/**
 * Class SubscriptionRequest
 *
 * @package Brightcove\API\Request
 * @api
 */
class SubscriptionRequest extends ObjectBase
{
    protected ?string $endpoint = null;
    protected array $events = [];

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'endpoint');
        $this->applyProperty($json, 'events');
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function setEndpoint(string $endpoint): static
    {
        $this->endpoint = $endpoint;
        $this->fieldChanged('endpoint');
        return $this;
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function setEvents(array $events): static
    {
        $this->events = $events;
        $this->fieldChanged('events');
        return $this;
    }
}
