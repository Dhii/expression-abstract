<?php

namespace Dhii\Espresso;

use Dhii\Data\ValueAwareInterface;

/**
 * Abstract implementation of a context.
 *
 * @since [*next-version*]
 */
abstract class AbstractContext implements ContextInterface, ValueAwareInterface
{
    /**
     * The value.
     *
     * @since [*next-version*]
     *
     * @var mixed
     */
    protected $value;

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value.
     *
     * @since [*next-version*]
     *
     * @param mixed $value The new value.
     *
     * @return $this This instance.
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
