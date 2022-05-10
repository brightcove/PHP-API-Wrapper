<?php

declare(strict_types=1);

namespace Brightcove\Item\InPageExperience;

use Brightcove\Item\ObjectInterface;
use Countable;
use Iterator;

/**
 * In-Page Experience entity list interface.
 */
interface InPageExperienceListInterface extends Countable, Iterator, ObjectInterface
{
    /**
     * Gets the list of entities.
     *
     * @return \Brightcove\Item\InPageExperience\InPageExperience[]
     */
    public function getItems(): array;
}
