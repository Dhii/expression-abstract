<?php

namespace Dhii\Espresso\Term;

use Dhii\Data\ValueAwareInterface;
use Dhii\Espresso\ContextInterface;
use Dhii\Espresso\EvalException;
use Dhii\Evaluable\EvaluableInterface;

/**
 * A term whose value can vary depending on the context.
 *
 * @since [*next-version*]
 */
class VariableTerm implements EvaluableInterface
{
    /**
     * The variable identifier.
     *
     * @since [*next-version*]
     *
     * @var string
     */
    protected $identifier;

    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param string $identifier The variable identifier.
     */
    public function __construct($identifier)
    {
        $this->setIdentifier($identifier);
    }

    /**
     * Gets the identifier.
     *
     * @since [*next-version*]
     *
     * @return string The identifier.
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Sets the identifier.
     *
     * @since [*next-version*]
     *
     * @param string $identifier The new identifier.
     *
     * @return $this This instance.
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     *
     * @throws \Dhii\Espresso\EvalException If no context value
     */
    public function evaluate(ValueAwareInterface $ctx = null)
    {
        $identifier = $this->getIdentifier();

        if ($ctx instanceof ContextInterface && $ctx->hasValue($identifier)) {
            return $ctx->getValue($identifier);
        }

        throw $this->newEvalException('No context value given for VariableTerm "%s"', $this->getIdentifier());
    }

    /**
     * Creates an evaluation exception.
     *
     * @since [*next-version*]
     *
     * @param array $args A variable number of arguments that represent the message and
     *                    interpolation values, similar to the `printf()` family of functions.
     *
     * @return \Dhii\Espresso\EvalException The exception.
     */
    protected function newEvalException(/* array $args... */)
    {
        $msg = call_user_func_array('sprintf', func_get_args());

        return new EvalException($msg);
    }
}
