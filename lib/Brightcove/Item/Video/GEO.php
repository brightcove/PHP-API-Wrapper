<?php

declare(strict_types=1);

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * If geo-restriction is enabled for the account,
 * this class creates geo objects.
 * This object will contain geo-restriction properties for the video.
 *
 * @api
 */
class GEO extends ObjectBase
{
    protected array $countries = [];
    protected bool $exclude_countries = false;
    protected bool $restricted = false;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'countries');
        $this->applyProperty($json, 'exclude_countries');
        $this->applyProperty($json, 'restricted');
    }

    public function getCountries(): array
    {
        return $this->countries;
    }

    public function setCountries(array $countries): static
    {
        $this->countries = $countries;
        $this->fieldChanged('countries');
        return $this;
    }

    public function isExcludeCountries(): bool
    {
        return $this->exclude_countries;
    }

    public function setExcludeCountries(bool $exclude_countries): static
    {
        $this->exclude_countries = $exclude_countries;
        $this->fieldChanged('exclude_countries');
        return $this;
    }

    public function isRestricted(): bool
    {
        return $this->restricted;
    }

    public function setRestricted(bool $restricted): static
    {
        $this->restricted = $restricted;
        $this->fieldChanged('restricted');
        return $this;
    }
}
