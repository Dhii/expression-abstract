<?php

namespace Dhii\Espresso\Context;

/**
 * A composite context implementation with array access support.
 *
 * @since [*next-version*]
 */
class ArrayContext extends CompositeContext implements \ArrayAccess
{
    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return $this->hasValue($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->getValue($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->setValue($offset, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $this->removeValue($offset);
    }
}
