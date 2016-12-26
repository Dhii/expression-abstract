<?php

namespace Dhii\Espresso\Context;

use Dhii\Espresso\AbstractContext;

/**
 * Description of RawContext.
 *
 * @since [*next-version*]
 */
class RawContext extends AbstractContext
{
    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param mixed $value The context value.
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }
}
