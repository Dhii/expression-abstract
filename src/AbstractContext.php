<?php

namespace Dhii\Expression;

/**
 * Abstract implementation of a context.
 *
 * @since [*next-version*]
 */
abstract class AbstractContext
{
    /**
     * The contextual value.
     *
     * @since [*next-version*]
     *
     * @var mixed
     */
    protected $value;

    /**
     * Retrieves the contextual value.
     *
     * @since [*next-version*]
     *
     * @return mixed The contextual value.
     */
    protected function _getValue()
    {
        return $this->value;
    }

    /**
     * Sets the contextual value.
     *
     * @since [*next-version*]
     *
     * @param mixed $value The contextual value.
     *
     * @return $this This instance.
     */
    protected function _setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
