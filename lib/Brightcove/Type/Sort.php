<?php

declare(strict_types=1);

namespace Brightcove\Type;

/**
 * Sort type.
 */
final class Sort implements SortInterface
{

    /**
     * Initializes a sort type.
     *
     * @param string $fieldName
     *   The name of the field to order by.
     * @param SortOrder $order
     *   The order of the field.
     */
    public function __construct(
        private readonly string $fieldName,
        private readonly SortOrder $order = SortOrder::default
    ) {}

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return $this->order->value . $this->fieldName;
    }
}
