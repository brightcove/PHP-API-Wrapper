<?php

declare(strict_types=1);

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * The instance of this Class contains the sharing information of the video object.
 *
 * @api
 */
class Sharing extends ObjectBase
{
    /**
     * True, if the video was shared from another account.
     */
    protected bool $by_external_acct = false;

    /**
     * ID of the account that shared the video.
     */
    protected ?string $by_id = null;

    /**
     * ID of the video in its original account.
     */
    protected ?string $source_id = null;

    /**
     * Whether the video is shared to another account.
     */
    protected bool $to_external_acct = false;

    /**
     * Whether the video is shared by reference.
     */
    protected bool $by_reference = false;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'by_external_acct');
        $this->applyProperty($json, 'by_id');
        $this->applyProperty($json, 'source_id');
        $this->applyProperty($json, 'to_external_acct');
        $this->applyProperty($json, 'by_reference');
    }

    public function getByExternalAcct(): bool
    {
        return $this->by_external_acct;
    }

    public function setByExternalAcct(bool $by_external_acct): static
    {
        $this->by_external_acct = $by_external_acct;
        $this->fieldChanged('by_external_acct');
        return $this;
    }

    public function getById(): ?string
    {
        return $this->by_id;
    }

    public function setById(string $by_id): static
    {
        $this->by_id = $by_id;
        $this->fieldChanged('by_id');
        return $this;
    }

    public function getSourceId(): ?string
    {
        return $this->source_id;
    }

    public function setSourceId(string $source_id): static
    {
        $this->source_id = $source_id;
        $this->fieldChanged('source_id');
        return $this;
    }

    public function getToExternalAcct(): bool
    {
        return $this->to_external_acct;
    }

    public function setToExternalAcct(bool $to_external_acct): static
    {
        $this->to_external_acct = $to_external_acct;
        $this->fieldChanged('to_external_acct');
        return $this;
    }

    public function getByReference(): bool
    {
        return $this->by_reference;
    }

    public function setByReference(bool $by_reference): static
    {
        $this->by_reference = $by_reference;
        $this->fieldChanged('by_reference');
        return $this;
    }
}
