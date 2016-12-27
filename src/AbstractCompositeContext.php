<?php

namespace Dhii\Espresso;

/**
 * Abstract implementation of a composite context.
 *
 * @since [*next-version*]
 */
abstract class AbstractCompositeContext extends AbstractContext implements CompositeContextInterface
{
    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    abstract public function getValue($key = null);
}
