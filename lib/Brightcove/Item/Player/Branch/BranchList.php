<?php

declare(strict_types=1);

namespace Brightcove\Item\Player\Branch;

use Brightcove\Item\ObjectBase;

/**
 * Class BranchList
 *
 * @package Brightcove\Item\Player\Branch
 * @api
 */
class BranchList extends ObjectBase
{
    protected ?Branch $master = null;
    protected ?Branch $preview = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'master', null, Branch::class);
        $this->applyProperty($json, 'preview', null, Branch::class);
    }

    public function getMaster(): ?Branch
    {
        return $this->master;
    }

    public function setMaster(Branch $master): static
    {
        $this->master = $master;
        $this->fieldChanged('master');
        return $this;
    }

    public function getPreview(): ?Branch
    {
        return $this->preview;
    }

    public function setPreview(Branch $preview): static
    {
        $this->preview = $preview;
        $this->fieldChanged('preview');
        return $this;
    }
}
