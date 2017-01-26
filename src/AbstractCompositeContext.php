<?php

namespace Dhii\Expression;

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
        return $this->hasValue($key)
            ? $this->_getValueOf($key)
            : null;
    }

    /**
     * Gets the contextual value associated with the given key.
     *
     * @internal The {@see AbstractCompositeContext::getValueOf} method already checks for the exists of
     *           the given key so none such check is required in the implementation of this method.
     *
     * @param string $key The key.
     *
     * @return mixed The value associated with the given key.
     */
    abstract protected function _getValueOf($key);
}
