<?php

declare(strict_types=1);

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * Class StudioConfiguration
 *
 * @package Brightcove\Item\Player\Branch\Configuration
 * @api
 */
class StudioConfiguration extends ObjectBase
{
    protected ?StudioConfigurationPlayer $player = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'player', null, StudioConfigurationPlayer::class);
    }

    public function getPlayer(): ?StudioConfigurationPlayer
    {
        return $this->player;
    }

    /**
     * @param StudioConfigurationPlayer $player
     * @return StudioConfiguration
     */
    public function setPlayer(StudioConfigurationPlayer $player): static
    {
        $this->player = $player;
        $this->fieldChanged('player');
        return $this;
    }
}
