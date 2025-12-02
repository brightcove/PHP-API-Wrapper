<?php

declare(strict_types=1);

namespace Brightcove\Item\Player\Branch\Configuration;

use Brightcove\Item\ObjectBase;

/**
 * Class VideoCloud
 *
 * @package Brightcove\Item\Player\Branch\Configuration
 * @api
 */
class VideoCloud extends ObjectBase
{
    protected ?string $policy_key = null;
    protected ?string $video = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'policy_key');
        $this->applyProperty($json, 'video');
    }

    public function getPolicyKey(): ?string
    {
        return $this->policy_key;
    }

    public function setPolicyKey(string $policy_key): static
    {
        $this->policy_key = $policy_key;
        $this->fieldChanged('policy_key');
        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(string $video): static
    {
        $this->video = $video;
        $this->fieldChanged('video');
        return $this;
    }
}
