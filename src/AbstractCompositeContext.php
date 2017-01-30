<?php

namespace Dhii\Expression;

/**
 * Abstract implementation of a composite context.
 *
 * @since 0.1
 */
abstract class AbstractCompositeContext extends AbstractContext
{
    /**
     * Gets the contextual value associated with the given key.
     *
     * @since 0.1
     *
     * @param string $key The key.
     *
     * @return mixed The value associated with the given key.
     */
    protected function _getValueOf($key)
    {
        return $this->_hasValue($key)
            ? $this->value[$key]
            : null;
    }

    /**
     * Checks if the context has a value associated with a specific key.
     *
     * @since 0.1
     *
     * @param string $key The key.
     *
     * @return bool True if a value exists for the given key; false otherwise.
     */
    protected function _hasValue($key)
    {
        return isset($this->value[$key]);
    }

    /**
     * Registers a value to the context.
     *
     * @since 0.1
     *
     * @param string|array $key   The key of the value or an associative array of values.
     * @param mixed        $value The value.
     *
     * @return $this This instance.
     */
    protected function _setValue($key, $value = null)
    {
        if (is_array($key)) {
            $this->value = $key;

            return $this;
        }

        $this->value[$key] = $value;

        return $this;
    }

    /**
     * Removes a value from the context.
     *
     * @param string $key The key.
     *
     * @return $this This instance.
     */
    protected function _removeValue($key)
    {
        unset($this->value[$key]);

        return $this;
    }

    /**
     * Clears the context by removing all values.
     *
     * @since 0.1
     *
     * @return $this
     */
    protected function _clearValues()
    {
        $this->value = array();

        return $this;
    }

    /**
     * Gets all of the values in this context.
     *
     * @since 0.1
     *
     * @return array An associative array containing all the values mapped by their keys.
     */
    protected function _getValues()
    {
        return $this->value;
    }
}
