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
     * The values.
     *
     * @since [*next-version*]
     *
     * @var array
     */
    protected $values;

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

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getValue($key = null)
    {
        return is_null($key)
            ? $this->values
            : $this->values[$key];
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function hasValue($key)
    {
        return isset($this->values[$key]);
    }

    /**
     * Sets the values or a single value.
     *
     * @since [*next-version*]
     *
     * @param string|array $key   The key of the value to set, or an array of values.
     * @param mixed        $value [optional] The value to set. Default: null
     *
     * @return $this This instance.
     */
    public function setValue($key, $value = null)
    {
        if (is_null($value)) {
            $this->values = $key;
        } else {
            $this->values[$key] = $value;
        }

        return $this;
    }

    /**
     * Removes a value.
     *
     * @since [*next-version*]
     *
     * @param string $key The key of the value to remove.
     *
     * @return $this This instance.
     */
    public function removeValue($key)
    {
        unset($this->values[$key]);

        return $this;
    }
}
