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
     * The value.
     *
     * @since [*next-version*]
     *
     * @var mixed
     */
    protected $value;

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

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value.
     *
     * @since [*next-version*]
     *
     * @param mixed $value The new value.
     *
     * @return $this This instance.
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
