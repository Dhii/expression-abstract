<?php

namespace Dhii\Espresso\Context;

use Dhii\Espresso\AbstractCompositeContext;

/**
 * A context that has multiple values.
 *
 * @since [*next-version*]
 */
class CompositeContext extends AbstractCompositeContext
{
    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param array $values The context values.
     */
    public function __construct(array $values)
    {
        $this->setValues($values);
    }
}
