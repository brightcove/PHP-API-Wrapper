<?php

declare(strict_types=1);

namespace Brightcove\Item\Video;

use Brightcove\Item\ObjectBase;

/**
 * Class Source
 *
 * @package Brightcove\Item\Video
 * @api
 */
class Source extends ObjectBase
{
    protected ?string $id = null;
    protected ?string $app_name = null;
    protected ?string $stream_name = null;
    protected ?string $codec = null;
    protected ?string $container = null;
    protected ?int $encoding_rate = null;
    protected ?int $duration = null;
    protected ?int $height = null;
    protected ?int $width = null;
    protected ?int $size = null;
    protected ?string $uploaded_at = null;
    protected ?string $src = null;
    protected mixed $type = null;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'id');
        $this->applyProperty($json, 'app_name');
        $this->applyProperty($json, 'stream_name');
        $this->applyProperty($json, 'codec');
        $this->applyProperty($json, 'container');
        $this->applyProperty($json, 'encoding_rate');
        $this->applyProperty($json, 'duration');
        $this->applyProperty($json, 'height');
        $this->applyProperty($json, 'width');
        $this->applyProperty($json, 'size');
        $this->applyProperty($json, 'uploaded_at');
        $this->applyProperty($json, 'src');
        $this->applyProperty($json, 'type');
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function setSrc(string $src): static
    {
        $this->src = $src;
        $this->fieldChanged('src');
        return $this;
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

    public function getAppName(): ?string
    {
        return $this->app_name;
    }

    public function setAppName(string $app_name): static
    {
        $this->app_name = $app_name;
        $this->fieldChanged('app_name');
        return $this;
    }

    public function getStreamName(): ?string
    {
        return $this->stream_name;
    }

    public function setStreamName(string $stream_name): static
    {
        $this->stream_name = $stream_name;
        $this->fieldChanged('stream_name');
        return $this;
    }

    public function getCodec(): ?string
    {
        return $this->codec;
    }

    public function setCodec(string $codec): static
    {
        $this->codec = $codec;
        $this->fieldChanged('codec');
        return $this;
    }

    public function getContainer(): ?string
    {
        return $this->container;
    }

    public function setContainer(string $container): static
    {
        $this->container = $container;
        $this->fieldChanged('container');
        return $this;
    }

    public function getEncodingRate(): ?int
    {
        return $this->encoding_rate;
    }

    public function setEncodingRate(int $encoding_rate): static
    {
        $this->encoding_rate = $encoding_rate;
        $this->fieldChanged('encoding_rate');
        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;
        $this->fieldChanged('duration');
        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): static
    {
        $this->height = $height;
        $this->fieldChanged('height');
        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(int $width): static
    {
        $this->width = $width;
        $this->fieldChanged('width');
        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): static
    {
        $this->size = $size;
        $this->fieldChanged('size');
        return $this;
    }

    public function getUploadedAt(): ?string
    {
        return $this->uploaded_at;
    }

    public function setUploadedAt(string $uploaded_at): static
    {
        $this->uploaded_at = $uploaded_at;
        $this->fieldChanged('uploaded_at');
        return $this;
    }

    public function getType(): mixed
    {
        return $this->type;
    }

    public function setType(mixed $type): static
    {
        $this->type = $type;
        $this->fieldChanged('type');
        return $this;
    }
}
