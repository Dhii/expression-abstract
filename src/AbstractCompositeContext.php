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
    public function getValueOf($key)
    {
        if ($this->hasValue($key)) {
            $values = $this->getValue();
            return $values[$key];
        }

        return null;
    }
}
