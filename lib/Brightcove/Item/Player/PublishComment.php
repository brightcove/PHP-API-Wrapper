<?php

declare(strict_types=1);

namespace Brightcove\Item\Player;

use Brightcove\Item\ObjectBase;

/**
 * Class PublishComment
 *
 * @package Brightcove\Item\Player
 * @api
 */
class PublishComment extends ObjectBase
{
    protected ?string $comment;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);

        $this->applyProperty($json, 'comment');
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;
        $this->fieldChanged('comment');
        return $this;
    }
}
