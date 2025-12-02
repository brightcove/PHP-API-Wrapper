<?php

namespace Brightcove\Item\Player\Branch;

use Brightcove\Item\ObjectBase;
use Brightcove\Item\Player\Branch\Configuration\Configuration;

/**
 * Class Branch
 *
 * @package Brightcove\Item\Player\Branch
 * @api
 */
class Branch extends ObjectBase
{
    protected ?Configuration $configuration = null;
    protected ?string $updated_at = null;
    protected ?string $template_updated_at = null;

    protected ?string $master_url = null;
    protected ?string $preview_url = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'configuration', null, Configuration::class);
        $this->applyProperty($json, 'updated_at');
        $this->applyProperty($json, 'master_url');
        $this->applyProperty($json, 'template_updated_at');
        $this->applyProperty($json, 'preview_url');
    }

    public function getConfiguration(): ?Configuration
    {
        return $this->configuration;
    }

    public function setConfiguration(Configuration $configuration): static
    {
        $this->configuration = $configuration;
        $this->fieldChanged('configuration');
        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): static
    {
        $this->updated_at = $updated_at;
        $this->fieldChanged('updated_at');
        return $this;
    }

    public function getMasterUrl(): ?string
    {
        return $this->master_url;
    }

    public function setMasterUrl(string $master_url): static
    {
        $this->master_url = $master_url;
        $this->fieldChanged('master_url');
        return $this;
    }

    public function getTemplateUpdatedAt(): ?string
    {
        return $this->template_updated_at;
    }

    public function setTemplateUpdatedAt(string $template_updated_at): static
    {
        $this->template_updated_at = $template_updated_at;
        $this->fieldChanged('template_updated_at');
        return $this;
    }

    public function getPreviewUrl(): ?string
    {
        return $this->preview_url;
    }

    public function setPreviewUrl(string $preview_url): static
    {
        $this->preview_url = $preview_url;
        $this->fieldChanged('preview_url');
        return $this;
    }
}
