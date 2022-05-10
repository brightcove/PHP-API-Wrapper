<?php

declare(strict_types=1);

namespace Brightcove\Type;

/**
 * Sort type.
 */
final class Sort implements SortInterface
{
    /**
     * The name of the field to order by.
     *
     * @var string
     */
    private $fieldName;

    /**
     * The order of the field.
     *
     * @var string
     */
    private $order;

    /**
     * Initializes a sort type.
     *
     * @param  string  $field_name
     *   The name of the field to order by.
     * @param  string  $order
     *   The order of the field.
     */
    public function __construct(string $field_name, string $order = self::ORDER_DEFAULT)
    {
        // Validate order.
        if (!in_array($order, [self::ORDER_DEFAULT, self::ORDER_REVERSE])) {
            throw new \InvalidArgumentException('Invalid order.');
        }

        $this->fieldName = $field_name;
        $this->order = $order;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return $this->order . $this->fieldName;
    }
}
