<?php

namespace Dhii\Espresso\Term;

use Dhii\Data\ValueAwareInterface;
use Dhii\Evaluable\EvaluableInterface;

/**
 * A term with a literal value.
 *
 * @since [*next-version*]
 */
class LiteralTerm implements EvaluableInterface
{
    /**
     * The literal value.
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
     * @param mixed $value The literal value.
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * Gets the literal value.
     *
     * @since [*next-version*]
     *
     * @return mixed The literal value.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the literal value.
     *
     * @since [*next-version*]
     *
     * @param mixed $value The new literal value.
     *
     * @return LiteralTerm This instance.
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function evaluate(ValueAwareInterface $ctx = null)
    {
        return $this->getValue();
    }
}
