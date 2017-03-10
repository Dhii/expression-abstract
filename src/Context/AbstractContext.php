<?php

namespace Dhii\Expression\Context;

/**
 * Abstract implementation of a context.
 *
 * @since 0.1
 */
abstract class AbstractContext
{
    /**
     * The contextual value.
     *
     * @since 0.1
     *
     * @var mixed
     */
    protected $value;

    /**
     * Retrieves the contextual value.
     *
     * @since 0.1
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
     * @since 0.1
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
