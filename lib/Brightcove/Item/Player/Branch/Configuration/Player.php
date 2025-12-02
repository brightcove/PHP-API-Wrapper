<?php

declare(strict_types=1);

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * Class Player
 *
 * @package Brightcove\Item\Player\Branch\Configuration
 * @api
 */
class Player extends ObjectBase
{
    protected ?PlayerTemplate $template = null;
    protected bool $inactive = false;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'template', null, PlayerTemplate::class);
        $this->applyProperty($json, 'autoplay');
    }

    public function getTemplate(): ?PlayerTemplate
    {
        return $this->template;
    }

    public function setTemplate(PlayerTemplate $template): static
    {
        $this->template = $template;
        $this->fieldChanged('template');
        return $this;
    }

    public function isInactive(): bool
    {
        return $this->inactive;
    }

    public function setInactive(bool $inactive): static
    {
        $this->inactive = $inactive;
        $this->fieldChanged('inactive');
        return $this;
    }
}
